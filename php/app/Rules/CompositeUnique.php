<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CompositeUnique implements Rule
{
    protected $tableName, $mainColumn, $column1, $value1, $column2, $value2, $exceptId;


    public function __toString()
    {
        return 'composite_unique';
    }

    /**
     * CompositeUnique constructor.
     *
     * @param string $mainColumn
     * @param string $tableName
     * @param string $column1
     * @param $value1
     * @param string|null $column2
     * @param null $value2
     * @param null $exceptId
     */
    public function __construct(string $tableName, string $mainColumn, string $column1, $value1, string $column2 = null, $value2 = null, $exceptId = null)
    {
        $this->tableName = $tableName;
        $this->mainColumn = $mainColumn;
        $this->column1 = $column1;
        $this->value1 = $value1;
        $this->column2 = $column2;
        $this->value2 = $value2;
        $this->exceptId = $exceptId;
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
        $query = DB::table($this->tableName)
            ->whereNull('deleted_at')
            ->where('id', '!=', $this->exceptId)
            ->where($this->mainColumn, $value)
            ->where($this->column1, $this->value1);
        if (($this->column2 != null) && ($this->value2 != null)) {
            $query = $query->where($this->column2, $this->value2);
        }
        if ($query->exists()) {
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
        if ($this->tableName == 'attachments') return ':attribute' . ' ' . __('already exists in the same folder');
        return ':attribute' . ' ' . __('and some of the other data together has already exist');
    }
}
