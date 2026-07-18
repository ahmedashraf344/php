<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CleanString implements Rule
{
    public function __toString()
    {
        return 'clean_string';
    }

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match('/^[\w\s?]+$/si', $value) &&
            !preg_match('/[\x{0600}-\x{06FF}\x]{1,32}/u', $value)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' :attribute' . ' ' . __('does not accept special letters');
    }
}
