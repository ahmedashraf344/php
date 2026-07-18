<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequireEditor implements Rule
{
    public function __toString()
    {
        return 'require_editor';
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
        $value=clean_html_input_value($value);
        if ($value == '' || $value == null) {
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
        return ':attribute' . ' ' . __('field is required');
    }
}
