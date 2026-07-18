<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes, ColumnAccessor;

    const STATUS_PENDING = 0;
    const STATUS_CONTACTED = 1;
    const STATUS = [
        self::STATUS_PENDING,
        self::STATUS_CONTACTED,
    ];

    protected $fillable = [
        'email',
        'message',
        'status'
    ];

    //---------------------- other functions ---------------

    public static function selectStatusList()
    {
        return [
            self::STATUS_PENDING => __('waiting contact'),
            self::STATUS_CONTACTED => __('contacted'),
        ];
    }
}
