<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Has18Years implements Rule
{
    public function passes($attribute, $value)
    {
        $birthdate = \Carbon\Carbon::parse($value);
        $age = $birthdate->age;
        return $age >= 18;
    }

    public function message()
    {
        return 'The :attribute must be at least 18 years old.';
    }
}