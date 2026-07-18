<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, ColumnAccessor;

    const STATUS_PUBLISHED = 1;
    const STATUS_IN_REVIEW = 0;
    const STATUS = [
        self::STATUS_IN_REVIEW,
        self::STATUS_PUBLISHED,
    ];

    const MODEL_TYPE = [
        // Post::class,
        Shop::class,
    ];

    protected $fillable = [
        'content',
        'user_id',
        'status',
        'model_id',
        'model_type',
        'positive_type'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => __('administration')
        ]);
    }

    // -------------------- accessor and mutators ------------

    public function getStatusValueAttribute()
    {
        return self::selectStatusList()[$this['status']];
    }

    //---------------------- other functions ---------------

    public static function selectStatusList()
    {
        return [
            self::STATUS_IN_REVIEW => __('in review'),
            self::STATUS_PUBLISHED => __('published'),
        ];
    }

}
