<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\GroupChat;
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
        $employer_id = Auth::guard('employer')->id();
        $groupchats = GroupChat::where('employer_id', $employer_id)->get();
        return view('employer.chat.groupchatindex', compact('groupchats'));
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
            
            $user = GroupChat::where('group_name', 'like',  $request->group_name)->first();  
            if($user){
                notify()->error(__('Already exists'));
            }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('FNPF Created.'));
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
        $groupchat = GroupChat::find($id);
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
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
            
            $user = GroupChat::where('group_name', 'like',  $request->group_name)->first();  
            if($user){
                notify()->error(__('Already exists'));
            }else{
                $res = $data->save();
                if($res){
                    notify()->success(__('Group chat Updated.'));
                }else{
                    notify()->error(__('Failed to Update.'));
                }
            }
             
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
        $data = GroupChat::find($id);
        $res = $data->delete();

        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }

        return redirect()->back();
    }
}
