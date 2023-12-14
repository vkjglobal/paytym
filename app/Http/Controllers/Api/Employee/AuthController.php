<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserCapabilities;
use App\Models\Attendance;
use App\Models\Employer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;

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
            $employer = Employer::where('id', $authUser->employer_id)->first();

            if ($employer->status == '0') {
                return response()->json([
                    'message' => "The Employer is Inactive",
                ], 200);
            } else if ($authUser->status == '0') {
                return response()->json([
                    'message' => "Inactive Person",
                ], 200);
            } else {

                $success['token'] =  $authUser->createToken($authUser->first_name . '-MyToken')->plainTextToken;
                $casual = 0;
                $absence = 0;
                $annual = 0;
                $halfday = 0;

                $user_id = Auth::user()->id;
                $lastCheckedIn = Null;
                $lastAttendance = Attendance::where('user_id', $authUser->id)->latest()->first();
                if ($lastAttendance) {
                    if (is_null($lastAttendance->check_out)) {
                        $lastCheckedIn = $lastAttendance->check_in;
                    }
                }

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
                $capabilities_list = Schema::getColumnListing('user_capabilities');

                return response()->json([
                    'message' => "You have successfully logged in!",
                    'employee' => $authUser,
                    'token' => $success['token'],
                    'casual' => $casual,
                    'absence' => $absence,
                    'annual' => $annual,
                    'halfday' => $halfday,
                    'capabilities' => $capabilities,
                    // 'capabilities_list' => $capabilities_list,
                    'last_checked_in' => $lastCheckedIn,

                ], 200);
            }
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
            $authUser = User::where('email', $email)->first();
            // $authUser = Auth::user();
            if ($authUser) {
                $employer = Employer::where('id', $authUser->employer_id)->first();

                if ($employer->status == '0') {
                    return response()->json([
                        'message' => "The Employer is Inactive",
                    ], 200);
                } else if ($authUser->status == '0') {
                    return response()->json([
                        'message' => "Inactive Person",
                    ], 200);
                }

                Mail::to($email)->send(new SendOtp($otp));
                $authUser->otp = $otp;
                $authUser->update();
                return response()->json([
                    'message' => 'Please find the email otp'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'The provided email ID is not registered as an employee in the Paytm application.'
                ], 400);
            }
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
            $authUser = User::where('email', $request->email)->first();
            if ($authUser) {
                $authUser->password = Hash::make($request->password);
                $authUser->isFirst = 0;
                $authUser->update();
            } else {
                return response()->json([
                    'message' => 'It is not a registered email'
                ], 200);
            }


            return response()->json([
                'message' => 'Password changed successfully.'
            ], 200);
        }
    }


    public function apply_device_id(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' =>  'required',
            'device_id' => 'required'
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        } else {
            //
            $user = User::find($request->user_id);
            if ($user) {
                $user->device_id = $request->device_id;
                $issave = $user->save();
                if ($issave) {
                    return response()->json([
                        'message' => 'device id updated'
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => 'something went wrong'
                ], 200);
            }
        }
    }


    public function push_notification(Request $request, $employee_id, $message)
    {
        // $employee_id = $this->employees($employee_id);
        $user = User::find($employee_id);
        if ($user->device_id) {
            $deviceToken = $user->device_id;
            // $deviceToken ="dhHuifm_TwyPGGHeBcdGge:APA91bGl9CAyrpMCyifrPSfurBn-2rWA7IKKWEBYJhnEPfHW4FaXIYYEktFDjlqeELX_gucKghv4TZwIb2pBP4NrdULOlDMRiMi244ww1eppPJwBueHLmSNWUlF32_HdVz8plQqmmwt0";


            $url = 'https://fcm.googleapis.com/fcm/send';
            $headers = [
                'Authorization' => 'key=AAAAmB77ark:APA91bFXkWwXAW_cKzE_dRmc9efC0pHD4R-6tUXArCht88ABJi-50ug3pvDVcxs6Obe_Qj58D_jrJcCuKqkvja7BcVBqCQy_solhOb-1H1KzzCRvFTyicc3wrEJqBmF68mRMDwFR52h3',
                'Content-Type' => 'application/json'
            ];
            $data = [
                'to' => $deviceToken,
                'notification' => [
                    'title' => 'You have a new notification',
                    'body' => $message
                ],
            ];
            $response = Http::withHeaders($headers)->post($url, $data);

            // Check for HTTP errors
            if ($response->failed()) {
                throw new Exception('Failed to send FCM notification: ' . $response->body());
            }

            // Parse the response body
            $responseBody = $response->json();







            // $client = new Client([
            //     'headers' => [
            //         'Authorization' => 'key=AAAA4cDCVvc:APA91bEcUocR-KUherx0YW48Yv5mdZBKBnW7ZMQnPynTMw-JOddqTeXwo5bc3zwC4IIJ_Pd5UEyDGB0hb5lFAszrk0y5q_gvwbekWUHKJweB-aFiRdIssliYTwCZED__RmEARtnXl1Wx',
            //         'Content-Type' => 'application/json',
            //     ],
            // ]);

            // $response = $client->post('https://fcm.googleapis.com/fcm/send', [
            //     'json' => [
            //         'to' => $deviceToken,
            //         'notification' => [
            //             'title' => 'Title',
            //             'body' => $message
            //         ],
            //     ],
            // ]);


            // if ($response->getStatusCode() == 200) {
            //     dd($response);
            //     dd("Notification sent successfully");
            // } else {
            // dd("Failed to send notification");
            // }





            // $accessToken = "key=AAAA4cDCVvc:APA91bEcUocR-KUherx0YW48Yv5mdZBKBnW7ZMQnPynTMw-JOddqTeXwo5bc3zwC4IIJ_Pd5UEyDGB0hb5lFAszrk0y5q_gvwbekWUHKJweB-aFiRdIssliYTwCZED__RmEARtnXl1Wx";
            // //$accessToken = $request->bearerToken();
            // $data = array(
            //     'body' => 'Hello',
            //     'title' => $message
            // );
            // $json_data = json_encode($data);
            // //dd($json_data);
            // $response = Http::withHeaders([
            //     'Content-Type' => 'application/json',
            //     'Authorization' => $accessToken
            // ])->post('https://fcm.googleapis.com/fcm/send', [
            //     'to' => $device_id,
            //     'notification' => $json_data,
            // ]);
            // dd($response);
            return response()->json([
                'message' => 'device id updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sorry'
            ], 200);
        }

        //}
    }

    public function chat_notification(Request $request, $employees, $message, $last_message, $group_id)
    {
        foreach ($employees as $employee_id)
            $user = User::find($employee_id);
        if ($user->device_id) {
            $deviceToken = $user->device_id;
            // $deviceToken ="dhHuifm_TwyPGGHeBcdGge:APA91bGl9CAyrpMCyifrPSfurBn-2rWA7IKKWEBYJhnEPfHW4FaXIYYEktFDjlqeELX_gucKghv4TZwIb2pBP4NrdULOlDMRiMi244ww1eppPJwBueHLmSNWUlF32_HdVz8plQqmmwt0";


            $url = 'https://fcm.googleapis.com/fcm/send';
            $headers = [
                'Authorization' => 'key=AAAAmB77ark:APA91bFXkWwXAW_cKzE_dRmc9efC0pHD4R-6tUXArCht88ABJi-50ug3pvDVcxs6Obe_Qj58D_jrJcCuKqkvja7BcVBqCQy_solhOb-1H1KzzCRvFTyicc3wrEJqBmF68mRMDwFR52h3',
                'Content-Type' => 'application/json'
            ];
            $data = [
                'to' => $deviceToken,
                'notification' => [
                    'title' => 'You have a new notification',
                    'body' => $message
                ],
                'data' => [
                    'group_id' => $group_id,
                    'message' => $last_message
                ],
            ];
            $response = Http::withHeaders($headers)->post($url, $data);

            // Check for HTTP errors
            if ($response->failed()) {
                throw new Exception('Failed to send FCM notification: ' . $response->body());
            }

            // Parse the response body
            $responseBody = $response->json();

            return response()->json([
                'message' => 'device id updated'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sorry'
            ], 200);
        }
    }
}
