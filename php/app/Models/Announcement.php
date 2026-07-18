<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use App\Traits\ColumnTranslation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use SoftDeletes, ColumnAccessor, ColumnTranslation;

    const TYPE_FREE = 0;
    const TYPE_PAID = 1;
    const TYPES = [
        self::TYPE_FREE,
        self::TYPE_PAID,
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'feature_image',
        'description_ar',
        'description_en',
        'type',
        'enable_at',
        'disable_at',
    ];

    protected $appends = [];

    //------------------ scopes ---------------------------
    public function scopeEnabledAnnouncements($query)
    {
        return $query->where(function ($q) {
            $q->whereDate('enable_at', '<=', Carbon::parse(date('Y-m-d')))
                ->orWhere('enable_at', null);
        })->where(function ($q2) {
            $q2->where('disable_at', '!=', null)
                ->whereDate('disable_at', '>=', Carbon::parse(date('Y-m-d')))
                ->orWhere('disable_at', null);
        });
    }

    public function scopeDisabledAnnouncements($query)
    {
        return $query->where('enable_at', '!=', null)
            ->whereDate('enable_at', '>', Carbon::parse(date('Y-m-d')))
            ->orWhere(function ($q) {
                $q->where('disable_at', '!=', null)
                    ->whereDate('disable_at', '<', Carbon::parse(date('Y-m-d')));
            });
    }

    //------------------ accessor and mutator --------------

    public function getTypeValueAttribute()
    {
        return self::selectTypesList()[$this['type']];
    }

    // public function setDisableAtAttribute($value)
    // {
    //     if (!$value) $this->attributes['disable_at'] = null;
    // }

    // public function setEnableAtAttribute($value)
    // {
    //     if (!$value) $this->attributes['enable_at'] = null;
    // }

    public function getFeatureImageAttribute($value)
    {
        return (($value != null) || (Storage::exists($value))) ? asset($value) : null;
    }

    //---------------------- other functions ---------------

    public static function selectTypesList()
    {
        return [
            self::TYPE_FREE => __('free'),
            self::TYPE_PAID => __('paid'),
        ];
    }
}
