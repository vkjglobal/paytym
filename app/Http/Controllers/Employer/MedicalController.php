<?php

namespace App\Http\Controllers\Employer;

use App\Exports\Employer\PaymentExport;
use App\Http\Controllers\Controller;
use App\Models\EmployeeExtraDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MedicalController extends Controller
{
    public function index()
    {
        //
    }

    public function add($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('Medical')), null],
        ];
        $employee = User::where('id', $id)->first();
        return view('employer.user.medical_add',compact('employee','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blood_grp' => '',
            'allergies' => 'string',
            'medical_issues' => 'string',
            'measurement' => 'numeric',
        ]);
        $data = new EmployeeExtraDetails();
        $data->employee_id = $request->employee_id;
        $data->employer_id = Auth::guard('employer')->id();
        $data->blood_grp = $request->blood_grp;
        $data->allergies = $request->allergies;
        $data->medical_issues = $request->medical_issues;
        $data->measurement = $request->measurement;
        $issave = $data->save();

        if ($issave) {
            notify()->success(__('Added successfully'));
        } else {
            notify()->error(__('Failed to Add. Please try again'));
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('Medical')), null],
        ];
        $medical_detail = EmployeeExtraDetails::where('employee_id', $id)->first();
        return view('employer.user.medical_index', compact('breadcrumbs', 'medical_detail'));
    }

    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('Medical')), null],
        ];
        $medical_detail = EmployeeExtraDetails::where('id', $id)->first();
        $employee = User::where('id', $medical_detail->employee_id)->first();
        return view('employer.user.medical_edit',compact('employee','breadcrumbs','medical_detail'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'blood_grp' => '',
            'allergies' => 'string',
            'medical_issues' => 'string',
            'measurement' => 'numeric',
        ]);
        $data = EmployeeExtraDetails::findOrFail($id);
        // $data->employee_id = $request->employee_id;
        // $data->employer_id = Auth::guard('employer')->id();
        $data->blood_grp = $request->blood_grp;
        $data->allergies = $request->allergies;
        $data->medical_issues = $request->medical_issues;
        $data->measurement = $request->measurement;
        $issave = $data->save();

        if ($issave) {
            notify()->success(__('Edited successfully'));
        } else {
            notify()->error(__('Failed to Edit. Please try again'));
        }
        return redirect()->route('employer.medical.show', $data->employee_id);
    }

    public function destroy($id)
    {
        //
    }
}