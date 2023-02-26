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
            'project' => 'required',
            'job_type' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
