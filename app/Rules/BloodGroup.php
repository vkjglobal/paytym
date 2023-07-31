<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BloodGroup implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $validBloodGroups = ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'];
    
        return in_array($value, $validBloodGroups);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter valid blood group';
    }
}
