<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use Exception;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::all();
        return view('employer.attendance.index', compact('attendances'));
    }


    public function create()
    {
        $users = User::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.attendance.create', compact('users'));
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|not_in:select',
            'date' => 'required',
            'date1' => 'required',
            'status' => 'required',
        ]);
        $stor = new Attendance();
        $stor->employer_id = Auth::guard('employer')->id();
        $stor->user_id = $request->name;
        $stor->date = $request->date;
        $stor->check_in = $request->date1;
        $stor->check_out = $request->date2;
        $stor->status = $request->status;
        $issave = $stor->save();
        if($issave){
            notify()->success(__('Created successfully'));
                } else {
            notify()->error(__('Failed to Create. Please try again'));
                }

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return view('employer.attendance.edit', compact('attendance'));
    }


    public function update(Request $request, $id)
    {
        $up = Attendance::find($id);
        $up->date = $request->date;
        $up->check_in = $request->date1;
        $up->check_out = $request->date2;
        $up->status = $request->status;
        $res = $up->save();
        if ($res) {
            notify()->success(__('Update successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();

    }


    public function destroy($id)
    {
        $del = Attendance::findOrFail($id)->delete();
    
            if ($del) {
                notify()->success(__('Deleted successfully'));
            } else {
                notify()->error(__('Failed to Delete. Please try again'));
            }
            return redirect()->back();
    }

    public function csvfile(Request $request)
    {
        try{
            Excel::import(new AttendanceImport, request()->file('csvfile'));
            notify()->success(__('Upload file successfully'));
        }
        catch(Exception $e){
            notify()->error(__('Failed to upload file. Please try again '));
        }
        return redirect()->back();
    }
}
