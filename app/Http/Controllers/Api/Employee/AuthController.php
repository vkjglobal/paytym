<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserCapabilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

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
            $success['token'] =  $authUser->createToken($authUser->first_name . '-MyToken')->plainTextToken;
            $casual = 0;
            $absence = 0;
            $annual = 0;
            $halfday = 0;

            $user_id = Auth::user()->id;
            $leave = LeaveRequest::where('status', '1')->where('user_id', $user_id);
            if ($leave) {
                $casual = LeaveRequest::where('status', '1')->where('user_id', $user_id)->where('type', 'casual')->get();
                $casual = $casual->count();
                $absence = LeaveRequest::where('status', '1')->where('user_id', $user_id)->get();
                $absence = $absence->count();
                $annual = LeaveRequest::where('status', '1')->where('user_id', $user_id)->where('type', 'annual')->get();
                $annual = $annual->count();
                $halfday = LeaveRequest::where('status', '1')->where('user_id', $user_id)->where('type', 'halfday')->get();
                $halfday = $halfday->count();
            }
            $capabilities = UserCapabilities::with('role')->where('role_id', $authUser->position)->get();

            return response()->json([
                'message' => "You have successfully logged in!",
                'employee' => $authUser,
                'token' => $success['token'],
                'casual' => $casual,
                'absence' => $absence,
                'annual' => $annual,
                'halfday' => $halfday,
                'capabilities' => $capabilities,
            ], 200);
        } else {
            return response()->json([
                'message' => "Wrong credentials. Please try again."
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

    // Password Reset
    public function resetPassword(Request $request)
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
            $authUser->update();

            return response()->json([
                'message' => 'Password changed successfully.'
            ], 200);
        }
    }

    // Logout 
    public function logout()
    {
        $res =  auth()->user()->tokens()->delete();
        if ($res) {
            return response()->json([
                'message' => 'Logout Successfull'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Please try again.'
            ], 400);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $email = $request->email;
            $otp = rand(1000, 9999);
            Mail::to($email)->send(new SendOtp($otp));
            // save otp to users table
            $authUser = User::where('email', $email)->first();
            $authUser->otp = $otp;
            $authUser->update();
            return response()->json([
                'message' => 'Please find the email otp'
            ], 200);
        }
    }

    public function forgotPwd_confirmOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
            'otp' => 'required'
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            $otp = $user->otp;
        } else {
            return response()->json([
                'message' => 'No data Found'
            ], 400);
        }

        if ($otp == $request->otp) {
            return response()->json([
                'message' => 'Otp matched successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Please enter correct OTP.'
            ], 400);
        }
    }

    public function forgotPwd_updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email',
            'password' => 'required|same:c_password'
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            $authUser=User::where('email',$request->email)->first();
            if($authUser)
            {
                $authUser->password = Hash::make($request->password);
                $authUser->isFirst = 0;
                $authUser->update();
            }
            else
            {
                return response()->json([
                    'message' => 'It is not a registered email'
                ], 200);
            }
     

            return response()->json([
                'message' => 'Password changed successfully.'
            ], 200);
        }
    }


}
