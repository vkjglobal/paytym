<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCapabilitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            return [
            'role_name' => 'required',
            'projects' => 'nullable',
            'attendance' => 'nullable',
            'approve_attendance' => 'nullable',
            'medical' => 'nullable',
            'deductions' => 'nullable',
            'create_chat_groups' => 'nullable',
            'create_meetings' => 'nullable',
            'approve_leaves' => 'nullable',
            'view_payroll' => 'nullable',
            'calculate_payroll' => 'nullable',
            'manage_card' => 'required',
            'invoice_payments'=> 'nullable',
            'billing_email_edit' => 'nullable',
            'view_invoices' => 'nullable',
            'manage_business' => 'nullable',
            'manage_branches' => 'nullable',
            'manage_departments' => 'nullable',
            'view_business' => 'nullable',
            'view_branch' => 'nullable',
            'view_department' => 'nullable',
            'manage_payroll_budget' => 'nullable',
            'view_payroll_budget' => 'nullable',
            'add_employee' => 'nullable',
         //   'edit_employee' => 'nullable',
            'activate_inactivate' => 'nullable',
            'upload_doc' => 'required',
            'assign_projects'=> 'nullable',
            'view_medical_details' => 'nullable',
            // 'manage_contributions' => 'nullable',
            // 'view_contributions' => 'nullable',
            // 'manage_roles' => 'nullable',
            // 'view_roles' => 'nullable',
            // 'manage_user_capabilities' => 'nullable',
            // 'view_user_capabilities' => 'nullable',

            // 'manage_roster' => 'nullable',
            // 'view_roster' => 'nullable',
            // 'view_projects' => 'nullable',
            // 'view_attendance' => 'required',
            // 'manage_leavetypes'=> 'nullable',
            // 'approve_decline_leaverequest' => 'nullable',
            // 'view_status' => 'nullable',
            // 'view_split_payments' => 'nullable',
            // 'view_overtime_status' => 'nullable',
            // 'manage_overtime' => 'nullable',
            // 'approve_decline_overtime' => 'nullable',
            // 'payslip_settings' => 'nullable',
            // 'manage_allowance' => 'nullable',
            // 'view_allowance' => 'nullable',
            // 'view_advance_loan__paid' => 'nullable',
            // 'manage_advance_pay_loan' => 'nullable',
            // 'approve_decline_advance_pay_loan' => 'nullable',
            // 'manage_bonus' => 'nullable', 
            // 'view_bonus' => 'required',
            // 'create_manual_payment_record'=> 'nullable',
            // 'view_deduction' => 'nullable',
            // 'manage_commission' => 'nullable',
            // 'manage_uploads' => 'nullable',
            // 'view_download_uploads' => 'nullable',
            // 'manage_events' => 'nullable',
            // 'manage_holidays' => 'nullable',
            // 'download_allowance' => 'nullable',
            // 'view_employemnt_periods' => 'nullable',
            // 'view_deductions' => 'nullable',
            // 'view_pf_tax' => 'nullable',
            // 'view_status_active_inactive' => 'required',
            // 'download_attendance' => 'nullable',
            // 'download_deductions' => 'nullable',
            // 'download_pf_tax' => 'nullable',
            // 'download_status' => 'nullable',
            // 'download_projects' => 'nullable',
            // 'view_commissions' => 'nullable',
            // 'download_commission' => 'nullable',
            // 'download_payroll' => 'nullable',
            // 'view_advance_loan_pay' => 'nullable',
            // 'download_advance_loan_pay' => 'nullable',
            // 'create_remove_chat_members' => 'nullable',
            // 'add_support_ticket' => 'nullable',
            // 'view_support_ticket' => 'nullable',
        ];
        
    }
}
