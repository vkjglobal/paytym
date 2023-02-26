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
            'wages'=> 'nullable',
            'projects' => 'nullable',
            'attendance' => 'nullable',
            'approve_attendance' => 'nullable',
            'medical' => 'nullable',
            'contract_period' => 'nullable',
            'deductions' => 'nullable',
            'create_chat_groups' => 'nullable',
            'create_meetings' => 'nullable',
            'approve_leaves' => 'nullable',
            'view_payroll' => 'nullable',
            'approve_payroll' => 'nullable',
            'calculate_payroll' => 'nullable',
            'edit_deduction' => 'nullable'            
           
        ];
        
    }
}
