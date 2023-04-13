<?php

namespace App\Http\Requests\branch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
                'city' => 'required',
                'town' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'bank' => 'nullable',
                'account_number' => 'nullable',
                'qr_code' => 'nullable|mimes:png,jpg,jpeg,pdf|max:5048',
    
        ];
    }
}
