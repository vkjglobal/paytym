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
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Group Members')), null],
        ];
        $employer_id = Auth::guard('employer')->id();
        $groupchats = GroupChat::where('employer_id', $employer_id)->get();
        // $groupmembers = GroupChatMembers::get();
        // $admins = GroupChat::select('admin_id')->where('employer_id', $employer_id)->get();
        // return $admins;
        $groupmembers = GroupChatMembers::whereBelongsTo($groupchats, 'group')->orderBy('group_chat_id', 'ASC')->get();
        return view('employer.chat.addmembersindex', compact('breadcrumbs','groupmembers'));
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
            [(__('Group Members')), route('employer.groupmember.index')],
            [(__('Create')), null],
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
            
            $user = GroupChatMembers::where('member_id',  $request->employee)->where('group_chat_id', $request->group)->first();  
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
            [(__('Dashboard')), route('employer.home')],
            [(__('Group Members')), route('employer.groupmember.index')],
            [(__('Edit')), null],
        ];
        $groups =  GroupChat::where('employer_id', Auth::guard('employer')->id())->get();
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
            
            $user = GroupChatMembers::where('member_id',  $request->employee)->where('group_chat_id', $request->group)->first(); 
            if($user){
                notify()->error(__('Already exists'));
            }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('Group member Updated.'));
                }else{
                    notify()->error(__('Failed to Update.'));
                }
           // }
             
            return redirect()->route('employer.groupmember.index');
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
