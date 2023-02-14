<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Employer;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // Chats List
    
    public function index()
    {
        $user = Auth::user();
        $employer_id=$user->employer_id;
        $chats = Chat::where('user_id', $user->id)->get();
        $hod = Employer::where('id', $employer_id)->first();
        $chat_history = Chat::with('employer')->where(['user_id' => Auth::user()->id, 'employer_id' => $employer_id])->get();
  
        if ($chats->count() > 0) {
            return response()->json([
                'message' => "Success",
                'chats' => $chats,
                'hod' => $hod->name,
                'hod_image' => $hod->logo,
                'chat_history' => $chat_history,
            ], 200);
        } else {
            return response()->json([
                'message' => "No chat details found"
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

//list chat groups

public function list_chat_groups()
{
    $user = Auth::user();
    $chats = GroupChat::where('employee_id', $user->id)->get();
    if ($chats->count() > 0) {
        return response()->json([
            'message' => "Success",
            'chats' => $chats,
        ], 200);
    } else {
        return response()->json([
            'message' => "No chat details found"
        ], 400);
    }
}

//chat group details

public function list_chat_group_details(Request $request)
{
    $validator = Validator::make($request->all(), [
        'group_chat_id' =>  'required',
    ]);

    // if validation fails
    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first()
        ], 400);
    }
    // Save Chat


    $user = Auth::user();
    $chats = Chat::where('group_chat_id', $request->group_chat_id)->get();
    if ($chats->count() > 0) {
        return response()->json([
            'message' => "Success",
            'chats' => $chats,
        ], 200);
    } else {
        return response()->json([
            'message' => "No chat details found"
        ], 400);
    }
}


}
