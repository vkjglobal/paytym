<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\GroupChat;
use App\Models\GroupChatMembers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMembersAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employer_id = Auth::guard('employer')->id();
        // $groupmembers = GroupChatMembers::where('employer_id', $employer_id)->get();
        $groupmembers = GroupChatMembers::get();
        return view('employer.chat.addmembersindex', compact('groupmembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.project.index')],
            [(__('Chat')), null],
        ];
        $groups = GroupChat::where('employer_id', Auth::guard('employer')->id())->get();
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.chat.addmemberscreate', compact('breadcrumbs','employees','groups'));
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
            'group' => 'required',
        ]);
            $data = new GroupChatMembers();
            // $data->employer_id = Auth::guard('employer')->id();
            $data->group_chat_id = $request->group;
            $data->member_id = $request->employee;
            
            $user = GroupChatMembers::where('group_chat_id',$request->group)->where('member_id',  $request->employee)->first();  
            if($user){
                notify()->error(__('Already exists'));
            }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('Group Member Created.'));
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
            [(__('Dashboard')), route('employer.project.index')],
            [(__('Chat')), null],
        ];
        $groups = GroupChat::where('employer_id', Auth::guard('employer')->id())->get();
        $groupmembers = GroupChatMembers::find($id);
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.chat.addmembersedit', compact('breadcrumbs','employees','groupmembers','groups'));
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
            'employee' => 'required'
            //'group' => 'required',
        ]);
            $data = GroupChatMembers::where('id', $id)->first();
            // $data->employer_id = Auth::guard('employer')->id();
            $data->group_chat_id = $request->group;
            $data->member_id = $request->employee;
            
            // $user = GroupChatMembers::where('member_id',  $request->employee)->first(); 
            // if($user){
            //     notify()->error(__('Already exists'));
            // }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('Group member Updated.'));
                }else{
                    notify()->error(__('Failed to Update.'));
                }
           // }
             
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = GroupChatMembers::find($id);
        $res = $data->delete();

        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }

        return redirect()->back();
    }
}
