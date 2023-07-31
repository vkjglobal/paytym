<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRosterRequest extends FormRequest
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
            'employee' => 'required',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'mon_start' => 'nullable',
            'mon_end' => 'nullable',
            'tue_start' => 'nullable',
            'tue_end' => 'nullable',
            'wed_start' => 'nullable',
            'wed_end' => 'nullable',
            'thu_start' => 'nullable',
            'thu_end' => 'nullable',
            'fri_start' => 'nullable',
            'fri_end' => 'nullable',
            'sat_start' => 'nullable',
            'sat_end' => 'nullable',
            'sun_start' => 'nullable',
            'sun_end' => 'nullable',
        ];
    }
}
