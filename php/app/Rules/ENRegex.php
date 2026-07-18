<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ENRegex implements Rule
{
    public function __toString()
    {
        return 'en_regex';
    }

    protected $regex = '/^[\w\s?]+$/si';

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
        return ' :attribute'.' '.__('accepts english letters only');
    }
}
