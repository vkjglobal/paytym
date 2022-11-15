<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // Chats List
    public function index()
    {
        $user = Auth::user();
        $chats = Chat::where('user_id', $user->id)->get();

        if ($chats->count() > 0) {
            return response()->json([
                'message' => "Success",
                'chats' => $chats
            ], 200);
        } else {
            return response()->json([
                'message' => "fail"
            ], 400);
        }
    }

    // Chat Send
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employer_id' =>  'required',
            'message' =>  'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        // Save Chat
        $chat = new Chat();
        $chat->user_id = Auth::user()->id;
        $chat->employer_id = $request->employer_id;
        $chat->message = $request->message;
        $res = $chat->save();

        $hod = Employer::where('id', $request->employer_id)->first();
        $chats = Chat::with('employer')->where(['user_id' => Auth::user()->id, 'employer_id' => $request->employer_id])->get();
  
        if ($res) {
            return response()->json([
                'message' => "Success",
                'hod' => $hod->name,
                'hod_image' => $hod->logo,
                'chats' => $chats,
            ], 200);
        } else {
            return response()->json([
                'message' => "Fail"
            ], 400);
        }
    }
}
