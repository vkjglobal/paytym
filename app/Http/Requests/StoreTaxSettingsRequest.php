<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaxSettingsRequest extends FormRequest
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
            'annual_income_from' => 'required',
            'annual_income_to' => '',
            'income_tax_rate' => 'required',
            'income_tax_value' => 'required',
            'srt_tax' => 'required',
            'srt_value' => 'required',
        ];
    }
}
