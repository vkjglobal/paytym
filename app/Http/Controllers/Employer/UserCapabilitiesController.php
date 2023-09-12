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

        $roles = Role::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.user-capabilities.create', compact('breadcrumbs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //StoreUserCapabilitiesRequest
    public function store(Request $request)
    {
       // $validated = $request->validated();
        $usercapability = new UserCapabilities();
        $result = $this->capability_details($usercapability,$request);

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
        $roles = Role::where('employer_id', Auth::guard('employer')->user()->id)->get();

        return view('employer.user-capabilities.edit', compact('breadcrumbs', 'usercapability', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCapabilities  $userCapabilities
     * @return \Illuminate\Http\Response
     */
    //UpdateUserCapabilitiesRequest
    public function update(Request $request, UserCapabilities $usercapability)
    {
        $result = $this->capability_details($usercapability,$request);
        $issave = $usercapability->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('employer.usercapabilities.index');
    }




    public function capability_details($usercapability,$request)
    {
        $usercapability->role_id = $request->role_name;
        if ($request->has('manage_card')) {
      
            $usercapability->manage_card ='1';
        } else {
            $usercapability->manage_card ='0';
        }

        if ($request->has('invoice_payments')) {
            $usercapability->invoice_payments ='1';
        } else {
            $usercapability->invoice_payments ='0';
        }
        if ($request->has('billing_email_edit')) {
            $usercapability->billing_email_edit ='1';
        } else {
            $usercapability->billing_email_edit ='0';
        }

        if ($request->has('view_invoices')) {
            $usercapability->view_invoices ='1';
        } else {
            $usercapability->view_invoices ='0';
        }

        if ($request->has('manage_business')) {
            $usercapability->manage_business ='1';
        } else {
            $usercapability->manage_business ='0';
        }

        if ($request->has('manage_branches')) {
            $usercapability->manage_branches ='1';
        } else {
            $usercapability->manage_branches ='0';
        }

        if ($request->has('manage_departments')) {
            $usercapability->manage_departments ='1';
        } else {
            $usercapability->manage_departments ='0';
        }

        if ($request->has('view_business')) {
            $usercapability->view_business ='1';
        } else {
            $usercapability->view_business ='0';
        }

        if ($request->has('view_branch')) {
            $usercapability->view_branch ='0';
        } else {
            $usercapability->view_branch ='0';
        }

        if ($request->has('view_department')) {
            $usercapability->view_department ='1';
        } else {
            $usercapability->view_department ='0';
        }

        if ($request->has('manage_payroll_budget')) {
            $usercapability->manage_payroll_budget ='1';
        } else {
            $usercapability->manage_payroll_budget ='0';
        }

        if ($request->has('view_payroll_budget')) {
            $usercapability->view_payroll_budget ='1';
        } else {
            $usercapability->view_payroll_budget ='0';
        }

        if ($request->has('add_employee')) {
            $usercapability->add_employee ='1';
        } else {
            $usercapability->add_employee ='0';
        }

        if ($request->has('edit_employee')) {
            $usercapability->edit_employee ='1';
        } else {
            $usercapability->edit_employee ='0';
        }

        if ($request->has('activate_inactivate')) {
            $usercapability->activate_inactivate ='1';
        } else {
            $usercapability->activate_inactivate ='0';
        }

        if ($request->has('upload_doc')) {
            $usercapability->upload_doc ='1';
        } else {
            $usercapability->upload_doc ='0';
        }

        if ($request->has('assign_projects')) {
            $usercapability->assign_projects ='1';
        } else {
            $usercapability->assign_projects ='0';
        }

        if ($request->has('view_medical_details')) {
            $usercapability->view_medical_details ='1';
        } else {
            $usercapability->view_medical_details ='0';
        }

        if ($request->has('medical')) {
            $usercapability->medical ='1';
        } else {
            $usercapability->medical ='0';
        }
        if ($request->has('manage_contributions')) {
            $usercapability->manage_contributions ='1';
        } else {
            $usercapability->manage_contributions ='0';
        }

        if ($request->has('view_contributions')) {
            $usercapability->view_contributions ='1';
        } else {
            $usercapability->view_contributions ='0';
        }

        
        if ($request->has('manage_roles')) {
            $usercapability->manage_roles ='1';
        } else {
            $usercapability->manage_roles ='0';
        }
        if ($request->has('view_roles')) {
            $usercapability->view_roles ='1';
        } else {
            $usercapability->view_roles ='0';
        }
        if ($request->has('manage_user_capabilities')) {
            $usercapability->manage_user_capabilities ='1';
        } else {
            $usercapability->manage_user_capabilities ='0';
        }
        if ($request->has('view_user_capabilities')) {
            $usercapability->view_user_capabilities ='1';
        } else {
            $usercapability->view_user_capabilities ='0';
        }
        if ($request->has('manage_roster')) {
            $usercapability->manage_roster ='1';
        } else {
            $usercapability->manage_roster ='0';
        }

        if ($request->has('view_roster')) {
            $usercapability->view_roster ='1';
        } else {
            $usercapability->view_roster ='0';
        }



        if ($request->has('projects')) {
            $usercapability->projects ='1';
        } else {
            $usercapability->projects ='0';
        }

        if ($request->has('assign_projects')) {
            $usercapability->assign_projects ='1';
        } else {
            $usercapability->assign_projects ='0';
        }

        if ($request->has('view_projects')) {
            $usercapability->view_projects ='1';
        } else {
            $usercapability->view_projects ='0';
        }

        if ($request->has('attendance')) {
            $usercapability->attendance ='1';
        } else {
            $usercapability->attendance ='0';
        }

        if ($request->has('approve_attendance')) {
            $usercapability->approve_attendance ='1';
        } else {
            $usercapability->approve_attendance ='0';
        }
        if ($request->has('view_attendance')) {
            $usercapability->view_attendance ='1';
        } else {
            $usercapability->view_attendance ='0';
        }
        if ($request->has('manage_leavetypes')) {
            $usercapability->manage_leavetypes ='1';
        } else {
            $usercapability->manage_leavetypes ='0';
        }
        if ($request->has('approve_decline_leaverequest')) {
            $usercapability->approve_decline_leaverequest ='1';
        } else {
            $usercapability->approve_decline_leaverequest ='0';
        }
        if ($request->has('view_status')) {
            $usercapability->view_status ='1';
        } else {
            $usercapability->view_status ='0';
        }
        if ($request->has('view_payroll')) {
            $usercapability->view_payroll ='1';
        } else {
            $usercapability->view_payroll ='0';
        }
        if ($request->has('calculate_payroll')) {
            $usercapability->calculate_payroll ='1';
        } else {
            $usercapability->calculate_payroll ='0';
        }
        if ($request->has('view_split_payments')) {
            $usercapability->view_split_payments ='1';
        } else {
            $usercapability->view_split_payments ='0';
        }

        if ($request->has('view_overtime_status')) {
            $usercapability->view_overtime_status ='1';
        } else {
            $usercapability->view_overtime_status ='0';
        }




        if ($request->has('manage_overtime')) {
            $usercapability->manage_overtime ='1';
        } else {
            $usercapability->manage_overtime ='0';
        }

        if ($request->has('approve_decline_overtime')) {
            $usercapability->approve_decline_overtime ='1';
        } else {
            $usercapability->approve_decline_overtime ='0';
        }

        if ($request->has('payslip_settings')) {
            $usercapability->payslip_settings ='1';
        } else {
            $usercapability->payslip_settings ='0';
        }

        if ($request->has('manage_allowance')) {
            $usercapability->manage_allowance ='1';
        } else {
            $usercapability->manage_allowance ='0';
        }

        if ($request->has('view_allowance')) {
            $usercapability->view_allowance ='1';
        } else {
            $usercapability->view_allowance ='0';
        }
        if ($request->has('view_advance_loan__paid')) {
            $usercapability->view_advance_loan__paid ='1';
        } else {
            $usercapability->view_advance_loan__paid ='0';
        }
        if ($request->has('manage_advance_pay_loan')) {
            $usercapability->manage_advance_pay_loan ='1';
        } else {
            $usercapability->manage_advance_pay_loan ='0';
        }
        if ($request->has('approve_decline_advance_pay_loan')) {
            $usercapability->approve_decline_advance_pay_loan ='1';
        } else {
            $usercapability->approve_decline_advance_pay_loan ='0';
        }
        if ($request->has('manage_bonus')) {
            $usercapability->manage_bonus ='1';
        } else {
            $usercapability->manage_bonus ='0';
        }
        if ($request->has('view_bonus')) {
            $usercapability->view_bonus ='1';
        } else {
            $usercapability->view_bonus ='0';
        }
        if ($request->has('deductions')) {
            $usercapability->deductions ='1';
        } else {
            $usercapability->deductions ='0';
        }
        if ($request->has('create_manual_payment_record')) {
            $usercapability->create_manual_payment_record ='1';
        } else {
            $usercapability->create_manual_payment_record ='0';
        }

        if ($request->has('view_deduction')) {
            $usercapability->view_deduction ='1';
        } else {
            $usercapability->view_deduction ='0';
        }




        if ($request->has('manage_commission')) {
            $usercapability->manage_commission ='1';
        } else {
            $usercapability->manage_commission ='0';
        }

        if ($request->has('view_commission')) {
            $usercapability->view_commission ='1';
        } else {
            $usercapability->view_commission ='0';
        }

        if ($request->has('manage_uploads')) {
            $usercapability->manage_uploads ='1';
        } else {
            $usercapability->manage_uploads ='0';
        }

        if ($request->has('view_download_uploads')) {
            $usercapability->view_download_uploads ='1';
        } else {
            $usercapability->view_download_uploads ='0';
        }

        if ($request->has('manage_events')) {
            $usercapability->manage_events ='1';
        } else {
            $usercapability->manage_events ='0';
        }
        if ($request->has('create_meetings')) {
            $usercapability->create_meetings ='1';
        } else {
            $usercapability->create_meetings ='0';
        }
        if ($request->has('manage_holidays')) {
            $usercapability->manage_holidays ='1';
        } else {
            $usercapability->manage_holidays ='0';
        }
        if ($request->has('view_attendance')) {
            $usercapability->view_attendance ='1';
        } else {
            $usercapability->view_attendance ='0';
        }
        if ($request->has('view_allowance')) {
            $usercapability->view_allowance ='1';
        } else {
            $usercapability->view_allowance ='0';
        }
        if ($request->has('download_allowance')) {
            $usercapability->download_allowance ='1';
        } else {
            $usercapability->download_allowance ='0';
        }
        if ($request->has('view_employemnt_periods')) {
            $usercapability->view_employemnt_periods ='1';
        } else {
            $usercapability->view_employemnt_periods ='0';
        }
        if ($request->has('view_deductions')) {
            $usercapability->view_deductions ='1';
        } else {
            $usercapability->view_deductions ='0';
        }

        if ($request->has('view_pf_tax')) {
            $usercapability->view_pf_tax ='1';
        } else {
            $usercapability->view_pf_tax ='0';
        }




        if ($request->has('view_status_active_inactive')) {
            $usercapability->view_status_active_inactive ='1';
        } else {
            $usercapability->view_status_active_inactive ='0';
        }

        if ($request->has('view_projects')) {
            $usercapability->view_projects ='1';
        } else {
            $usercapability->view_projects ='0';
        }

        if ($request->has('download_attendance')) {
            $usercapability->download_attendance ='1';
        } else {
            $usercapability->download_attendance ='0';
        }

        if ($request->has('download_deductions')) {
            $usercapability->download_deductions ='1';
        } else {
            $usercapability->download_deductions ='0';
        }

        if ($request->has('download_pf_tax')) {
            $usercapability->download_pf_tax ='1';
        } else {
            $usercapability->download_pf_tax ='0';
        }
        if ($request->has('download_status')) {
            $usercapability->download_status ='1';
        } else {
            $usercapability->download_status ='0';
        }
        if ($request->has('download_projects')) {
            $usercapability->download_projects ='1';
        } else {
            $usercapability->download_projects ='0';
        }
        if ($request->has('view_commissions')) {
            $usercapability->view_commissions ='1';
        } else {
            $usercapability->view_commissions ='0';
        }
        if ($request->has('download_commission')) {
            $usercapability->download_commission ='1';
        } else {
            $usercapability->download_commission ='0';
        }
        if ($request->has('view_payroll')) {
            $usercapability->view_payroll ='1';
        } else {
            $usercapability->view_payroll ='0';
        }
        if ($request->has('download_payroll')) {
            $usercapability->download_payroll ='1';
        } else {
            $usercapability->download_payroll ='0';
        }
        if ($request->has('view_advance_loan_pay')) {
            $usercapability->view_advance_loan_pay ='1';
        } else {
            $usercapability->view_advance_loan_pay ='0';
        }

        if ($request->has('download_advance_loan_pay')) {
            $usercapability->download_advance_loan_pay ='1';
        } else {
            $usercapability->download_advance_loan_pay ='0';
        }


        if ($request->has('create_chat_groups')) {
            $usercapability->create_chat_groups ='1';
        } else {
            $usercapability->create_chat_groups ='0';
        }
        if ($request->has('create_remove_chat_members')) {
            $usercapability->create_remove_chat_members ='1';
        } else {
            $usercapability->create_remove_chat_members ='0';
        }
        if ($request->has('add_support_ticket')) {
            $usercapability->add_support_ticket ='1';
        } else {
            $usercapability->add_support_ticket ='0';
        }
        if ($request->has('view_support_ticket')) {
            $usercapability->view_support_ticket ='1';
        } else {
            $usercapability->view_support_ticket ='0';
        }
        $usercapability->employer_id = Auth::guard('employer')->user()->id;
       
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
