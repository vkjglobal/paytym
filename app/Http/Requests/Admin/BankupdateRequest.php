<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankupdateRequest extends FormRequest
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
            'country_id' => 'required',
            'bank_name' => 'required',
            'address' => 'required',
            'bank_code' => 'required',
            'branch_code' => 'required',
            'bank_template' => 'nullable|mimes:png,jpg,jpeg|max:5048',
        ];
    }
}
