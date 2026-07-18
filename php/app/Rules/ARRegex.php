<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ARRegex implements Rule
{
    public function __toString()
    {
        return 'ar_regex';
    }

    protected $regex = '/[\x{0600}-\x{06FF}\x]{1,32}/u';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /*if (!preg_match($this->regex,$value)){
            return false;
        }*/
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' :attribute'.' '.__('accepts arabic letters only');
    }
}
