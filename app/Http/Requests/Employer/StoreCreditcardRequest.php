<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditcardRequest extends FormRequest
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
            'primary_card_number' => 'required|numeric',
            'primary_name_on_card' => 'required',
            'primary_expiry_date' =>'required',
            'secondary_card_number' => 'required|numeric',
            'secondary_name_on_card' => 'required',
            'secondary_expiry_date' =>'required'
        ];
        
    }
}
