<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:employers,email',
            'phone' => 'required|numeric',
            'company_phone' => 'required|numeric',
            'street' => 'nullable',
            'city' => 'nullable',
            'phone' => 'nullable',
            'town' => 'nullable',
            'postcode' => 'nullable',
            'country' => 'required',
            'tin' => 'nullable',
            'website' => 'nullable',
            'registration_certificate' => 'nullable|mimes:png,jpg,jpeg,pdf|max:5048',
            'tin_letter' => 'nullable|mimes:png,jpg,jpeg,pdf|max:5048',
            'logo' => 'nullable|mimes:png,jpg,jpeg,pdf|max:5048',
        ];
    }
}
