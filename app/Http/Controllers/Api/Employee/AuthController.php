<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
            'password'   => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        // auth attempt
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyToken')->plainTextToken;

            return response()->json([
                'message' => "You have successfully logged in!",
                'employee' => $authUser,
                'token' => $success
            ], 200);
        } else {
            return response()->json([
                'message' => "Something went wrong. Please try again"
            ], 400);
        }
    }

    // send OTP
    public function sendOtp()
    {
        $authUser = Auth::user();

        if ($authUser->isFirst == 1) {
            if ($authUser->otp == null) {
                $otp = rand(1000, 9999);
                Mail::to($authUser->email)->send(new SendOtp($otp));

                // save otp to users table
                $authUser->otp = $otp;
                $authUser->update();

                return response()->json([
                    'message' => 'Please find the email otp'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong. Please try again.'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => "You're already verified."
            ], 400);
        }
    }

    // confirm OTP
    public function confirmOtp(Request $request)
    {
        $authUser = Auth::user();
        if ($authUser->otp == $request->otp) {
            return response()->json([
                'message' => 'Otp matched successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Please enter correct OTP.'
            ], 400);
        }
    }

    // Password Update
    public function updatePassword(Request $request)
    {
        $authUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $authUser->password = Hash::make($request->password);
            $authUser->isFirst = 0;
            $authUser->update();

            return response()->json([
                'message' => 'Password changed successfully.'
            ], 200);
        }
    }
}
