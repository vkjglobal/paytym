<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use App\Mail\CommonRequestEmailstoHR;
use Exception;
use Illuminate\Support\Facades\Auth;
use Mail;

class AttendanceController extends Controller
{

    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Attendance')), null],
        ];
        $attendances = Attendance::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.attendance.index', compact('breadcrumbs', 'attendances'));
    }


    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Attendance')), route('employer.attendance.index')],
            [(__('Create')), null],
        ];
        $users = User::where('employer_id', Auth::guard('employer')->id())->where('status', 1)->get();
        return view('employer.attendance.create', compact('breadcrumbs', 'users'));
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|not_in:select',
            'date' => 'required',
            'date1' => 'required',
        ]);
        $stor = new Attendance();
        $stor->employer_id = Auth::guard('employer')->id();
        $stor->user_id = $request->name;
        $stor->date = $request->date;
        $stor->check_in = $request->date1;
        if (isset($request->extra_hours)) {
            $stor->extra_hours = $request->extra_hours;
        }
        $issave = $stor->save();

        $user = User::where('id', $request->name)->first();
        $hr = User::join('roles', 'users.position', '=', 'roles.id')
        ->where('users.employer_id', Auth::guard('employer')->id())
        ->where('users.status', 1)
        ->where('roles.role_name', 'like', '%HR%')
        ->get();
        $emails = $hr->pluck('email');
                $recipients = $emails->toArray();
                if ($emails->count()>0) {
                    $content = $user->first_name . ' ' . $user->last_name . ' has checked in.';
                    $title = 'Employee check-in Notification';
                    $subject = 'Employee Checked in -' .$user->first_name ;
                    Mail::to($recipients)->send(new CommonRequestEmailstoHR($user,$content,$subject,$title));
                    } 
        if ($issave) {
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
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Attendance')), route('employer.attendance.index')],
            [(__('Edit')), null],
        ];
        $attendance = Attendance::find($id);
        return view('employer.attendance.edit', compact('breadcrumbs', 'attendance'));
    }


    public function update(Request $request, $id)
    {
        $up = Attendance::find($id);
        $up->date = $request->date;
        $up->check_in = $request->date1;
        //$up->status = $request->status;
        if (isset($request->extra_hours)) {
            $up->extra_hours = $request->extra_hours;
        }
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
        $request->validate([
            'csvfile' => 'required|mimes:csv,xls,xlsx',
        ]); 

        $file = $request->file('csvfile');
       //dd($file);
        try {
            Excel::import(new AttendanceImport, request()->file('csvfile'));
            notify()->success(__('Upload file successfully'));
        } catch (Exception $e) {
            notify()->error(__('Failed to upload file. Wrong csv format. Please try again'));
        }
        return redirect()->back();
    }
}
