<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class CheckInOutTime extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Checkin-Checkout time')), route('employer.checkinout')],
        ];
        $check_in_out_time = Employer::where('id', Auth::guard('employer')->id())->first();
        $check_in_time = Employer::where('id', Auth::guard('employer')->id())->value('check_in_time');
        $check_out_time = Employer::where('id', Auth::guard('employer')->id())->value('check_out_time');
        return view('employer.check-in-out-time.index',compact('breadcrumbs','check_in_out_time','check_in_time','check_out_time'));
    }

    public function update($id, Request $request)
    {
        $data = Employer::findOrFail($id);
        $data->check_in_time = $request->check_in_time;
        $data->check_out_time = $request->check_out_time;
        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated successfully.'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
}
