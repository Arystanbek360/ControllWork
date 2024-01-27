<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidExpiryDate implements Rule
{
    public function passes($attribute, $value)
    {
        if (!preg_match('/^(0[1-9]|1[0-2])\/(2[4-9]|3[0-9]|4[0-4])$/', $value)) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'The :attribute is not a valid expiry date. Format must be MM/YY, MM = 01-12, YY = 24-44.';
    }
}

