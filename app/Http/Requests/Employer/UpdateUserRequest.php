<?php

namespace App\Http\Requests\employer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password' => 'required'
        ];
    }
}
