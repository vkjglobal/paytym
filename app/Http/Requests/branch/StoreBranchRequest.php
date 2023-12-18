<?php

namespace App\Http\Requests\branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
            'name' => 'required',
            'business' => 'required',
            'town' => 'required',
            'postcode' => 'required',
            'country' => 'nullable',
            'bank' => 'nullable',
            'account_number' => 'nullable',
            'company_name' => 'nullable',
            'batch_no' => 'nullable'
        ];
    }
}
