<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'branch' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'street' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'country' => 'required',
            'tin' => 'required',
            'fnpf' => 'required',
            'bank' => 'required',
            'city' => 'required',
            'account_number' => 'required', 
            'image' => 'nullable|mimes:png,jpg,jpeg,pdf|max:5048',
            'password' => 'required',

            'business' => 'required',
            'department' => 'required',
            'bank_branch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payperiod' => 'nullable|numeric',
            'fixed-rate' => 'nullable|numeric',
            'hourly-rate' => 'nullable|numeric',
            'employeetype' => 'required',
            'work_days_per_week' => 'nullable|numeric',
            'Total_hours_per_week' => 'nullable|numeric',
            'Extra_hours_at_base_rate' => 'nullable|numeric',
            'salary_type' => 'required',
        ];
    }
}
