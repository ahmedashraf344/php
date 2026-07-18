<?php

namespace App\Rules;

use Html2Text\Html2Text;
use Illuminate\Contracts\Validation\Rule;

class MinEditor implements Rule
{
    protected $min;

    public function __toString()
    {
        return 'min_editor';
    }

    /**
     * Create a new rule instance.
     * @param int $min
     * @return void
     */
    public function __construct(int $min)
    {
        $this->min = $min;
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
        $value = strip_tags(clean_html_input_value((new Html2Text($value))->getText()));

        return (iconv_strlen ($value) > $this->min) || ($value==null);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute' . ' ' . __('must be at least') . ' ' . $this->min;
    }
}
