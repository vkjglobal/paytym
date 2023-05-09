<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\UserCapabilities;
use App\Http\Requests\Employer\StoreUserCapabilitiesRequest;
use App\Http\Requests\Employer\UpdateUserCapabilitiesRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Auth;

class UserCapabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
            $breadcrumbs = [
                [(__('Dashboard')), route('employer.usercapabilities.index')],
                [(__('User Capabilities')), null],
            ];

            $usercapability = UserCapabilities::with('role')->where('employer_id', Auth::guard('employer')->user()->id)->latest()->get();

            return view('employer.user-capabilities.index', compact('breadcrumbs', 'usercapability'));
        }
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
            [(__('User Capabilities')), route('employer.usercapabilities.index')],
            [(__('Create')), null]
        ];

        $roles = Role::get();
        return view('employer.user-capabilities.create', compact('breadcrumbs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCapabilitiesRequest $request)
    {

        $validated = $request->validated();
        $usercapability = new UserCapabilities();

        $usercapability->role_id = $validated['role_name'];
        $usercapability->wages = $validated['wages'];
        $usercapability->projects = $validated['projects'];
        $usercapability->attendance = $validated['attendance'];
        $usercapability->approve_attendance = $validated['approve_attendance'];
        $usercapability->medical = $validated['medical'];
        $usercapability->contract_period = $validated['contract_period'];
        $usercapability->deductions = $validated['deductions'];
        $usercapability->create_chat_groups = $validated['create_chat_groups'];
        $usercapability->create_meetings = $validated['create_meetings'];
        $usercapability->approve_leaves = $validated['approve_leaves'];
        $usercapability->view_payroll = $validated['view_payroll'];
        $usercapability->approve_payroll = $validated['approve_payroll'];
        $usercapability->calculate_payroll = $validated['calculate_payroll'];
        $usercapability->edit_deduction = $validated['edit_deduction'];
        $usercapability->employer_id = Auth::guard('employer')->user()->id;
        $role_id = UserCapabilities::where('role_id', '=', $request->input('role_name'))->where('employer_id', $usercapability->employer_id)->first();
        if ($role_id) {
            notify()->error(__('User Capabilities already created for this role'));
        } else {
            $issave = $usercapability->save();
            if ($issave) {
                notify()->success(__('Created successfully'));
            } else {
                notify()->error(__('Failed to Create. Please try again'));
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCapabilities  $userCapabilities
     * @return \Illuminate\Http\Response
     */
    public function show(UserCapabilities $userCapabilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCapabilities  $userCapabilities
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCapabilities $usercapability)
    {
        //dd($usercapability);
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('User Capabilities')), route('employer.usercapabilities.index')],
            [(__('Edit')), null]
        ];
        $roles = Role::get();

        return view('employer.user-capabilities.edit', compact('breadcrumbs', 'usercapability', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCapabilities  $userCapabilities
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserCapabilitiesRequest $request, UserCapabilities $usercapability)
    {
        $validated = $request->validated();
        $usercapability->role_id = $validated['role_name'];
        $usercapability->wages = $validated['wages'];
        $usercapability->projects = $validated['projects'];
        $usercapability->attendance = $validated['attendance'];
        $usercapability->approve_attendance = $validated['approve_attendance'];
        $usercapability->medical = $validated['medical'];
        $usercapability->contract_period = $validated['contract_period'];
        $usercapability->deductions = $validated['deductions'];
        $usercapability->create_chat_groups = $validated['create_chat_groups'];
        $usercapability->create_meetings = $validated['create_meetings'];
        $usercapability->approve_leaves = $validated['approve_leaves'];
        $usercapability->view_payroll = $validated['view_payroll'];
        $usercapability->approve_payroll = $validated['approve_payroll'];
        $usercapability->calculate_payroll = $validated['calculate_payroll'];
        $usercapability->edit_deduction = $validated['edit_deduction'];
        $usercapability->employer_id = Auth::guard('employer')->user()->id;

        $issave = $usercapability->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('employer.usercapabilities.index');
    }

    /**
     * Remo
     * ve the specified resource from storage.
     *
     * @param  \App\Models\UserCapabilities  $userCapabilities
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCapabilities $usercapability)
    {
        $res = $usercapability->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function userrolecreate()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('User Roles')), route('employer.usercapabilities.index')],
            [(__('Create')), null]
        ];

        $roles = Role::get();
        return view('employer.user-role.create', compact('breadcrumbs', 'roles'));



    }
}
