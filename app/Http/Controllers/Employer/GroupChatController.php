<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\GroupChat;
use App\Models\GroupChatMembers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Group Chat')), null],
        ];
        $employer_id = Auth::guard('employer')->id();
        $groupchats = GroupChat::where('employer_id', $employer_id)->get();
        return view('employer.chat.groupchatindex', compact('breadcrumbs','groupchats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Group Chat')), route('employer.groupchat.index')],
            [(__('Create')), null],
        ];
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.chat.groupchatcreate', compact('breadcrumbs','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee' => 'required',
            'group_name' => 'required|min:3',
        ]);
            $data = new GroupChat();
            $data->employer_id = Auth::guard('employer')->id();
            $data->admin_id = $request->employee;
            $data->group_name = $request->group_name;
            
            $user = GroupChat::where('group_name', 'like',  $request->group_name)->where('employer_id',Auth::guard('employer')->id())->first();  
            if($user){
                notify()->error(__('This group already exists'));
            }else{
                $res = $data->save();
                $members = new GroupChatMembers();
                $members->group_chat_id = $data->id;
                $members->member_id = $request->employee;
                $members->save();
                if($res){
                    notify()->success(__('Group Created Successfully.'));
                }else{
                    notify()->error(__('Failed to Create.'));
                }
            }
             
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Group Chat')), route('employer.groupchat.index')],
            [(__('Create')), null],
        ];
        
        $groupchat = GroupChat::find($id);
        $employees = GroupChatMembers::where('group_chat_id', $id)->get();
        // return $employees;

        // $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.chat.groupchatedit', compact('breadcrumbs','employees','groupchat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee' => 'required',
            'group_name' => 'required|min:3',
        ]);
            $data = GroupChat::where('id', $id)->first();
            $data->employer_id = Auth::guard('employer')->id();
            $data->admin_id = $request->employee;
            $data->group_name = $request->group_name;
            
            $user = GroupChat::where('admin_id', $request->employee)->where('group_name', 'like',  $request->group_name)->first();  
            if($user){
                notify()->error(__('Already exists'));
            }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('Group chat Updated.'));
                }else{
                    notify()->error(__('Failed to Update.'));
                }
            //}
             
            return redirect()->route('employer.groupchat.index');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = GroupChat::find($id);
        $res = $data->delete();

        if ($res) {
            $members = GroupChatMembers::where('group_chat_id', $id)->delete();
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }

        return redirect()->back();
    }
}
