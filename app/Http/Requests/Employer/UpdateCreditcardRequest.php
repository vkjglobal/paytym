<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreditcardRequest extends FormRequest
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
           /* 'primary_card_number' => ['required',function ($attribute, $value, $fail) {
                if (!is_numeric($value) || $value !== '*') { dd($value);
                    $fail("The $attribute must be numeric or contain an asterisk (*)");
                }
            }
        ],*/
            'primary_card_number' => 'required',
            'primary_name_on_card' => 'required',
            'primary_expiry_date' =>'required',
            'secondary_card_number' => 'required',
            'secondary_name_on_card' => 'required',
            'secondary_expiry_date' =>'required',
            'primary_is_default' => 'required',
            'secondary_is_default' => 'required'
        ];
    }
}
