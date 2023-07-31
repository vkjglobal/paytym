<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\HolidayManageRequest;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    //

    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.index')],
            [(__('Holiday')), null],
        ];

        $holiday = Leaves::where('employer_id', Auth::guard('employer')->user()->id)->get();

        return view('employer.holiday.index', compact('breadcrumbs', 'holiday'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Holiday')), route('employer.holiday.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer = Auth::guard('employer')->user()->id;
        return view('employer.holiday.create', compact('breadcrumbs', 'employer'));
    }


    public function store(Request $request)
    {
        $holiday = new Leaves();
        $holiday->name = $request['name'];
        $holiday->date = $request['holiday_date'];
        $holiday->type = '1';
        $holiday->employer_id = Auth::guard('employer')->user()->id;
        $holiday->country_id = Auth::guard('employer')->user()->country_id;
        $res = $holiday->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        $holidays=Leaves::where('id',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Holiday')), route('employer.holiday.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        return view('employer.holiday.edit', compact('breadcrumbs','holidays'));
    }


    public function update(Request $request,$id)
    {
        $holiday=Leaves::where('id',$id)->first();

        $holiday->name = $request['name'];
        $holiday->date = $request['holiday_date'];
        $res = $holiday->save();
        if($res){
                notify()->success(__('Updated successfully'));
            } else {
                notify()->error(__('Failed to Update. Please try again'));
            }
            return redirect()->route('employer.holiday.index');
    }

    public function destroy($id)
    {
        $res = Leaves::findOrFail($id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    //Change department Status
    // public function changeStatus(Request $request){
    //     $holiday = Leaves::find($request->id);
    //     $holiday->status = $request->status;
    //     $res=$holiday->save();
    //     if($res){
    //     return response()->json(['success' => 'Status change successfully.']);
    //     }
    // }


}
