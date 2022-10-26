<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
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
}
