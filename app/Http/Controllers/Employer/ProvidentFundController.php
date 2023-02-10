<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\ProvidentFund;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Provider;

class ProvidentFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = ProvidentFund::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.providentfund.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.providentfund.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new ProvidentFund();
        $data->employer_id = Auth::guard('employer')->id();
        $data->user_id = $request->employee;
        $data->user_rate = $request->user_rate;
        $data->employer_rate = $request->employer_rate;

        $user = ProvidentFund::where('user_id', $request->employee)->first();

        if($user){
            notify()->error(__('Already exists'));
        }else{
            $data->save();
            notify()->success(__('PF Create.'));
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
        //
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

        $data = ProvidentFund::find($id);
        $data->user_rate = $request->userrate;
        $data->employer_rate = $request->employerrate;
        $res = $data->save();

        if ($res) {
            notify()->success(__('Updated successfully.'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
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
        $data = ProvidentFund::find($id);
        $res = $data->delete();

        if ($res) {
            notify()->success(__('Deleted successfully.'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }

        return redirect()->back();
    }
}
