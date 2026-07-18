<?php

namespace App\Rules;

use Html2Text\Html2Text;
use Illuminate\Contracts\Validation\Rule;

class MaxEditor implements Rule
{
    protected $max;

    public function __toString()
    {
        return 'max_editor';
    }

    /**
     * Create a new rule instance.
     * @param int $max
     *
     * @return void
     */
    public function __construct(int $max)
    {
        $this->max = $max;
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
        $originalValue = strip_tags(clean_html_input_value((new Html2Text($value))->getText()));

        return (iconv_strlen ($originalValue) < $this->max) || ($originalValue == null);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute' . ' ' . __('can not be greater than') . ' ' . $this->max;
    }
}
