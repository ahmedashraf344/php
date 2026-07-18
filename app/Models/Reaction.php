<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    const STATUS_NONE = 0;
    const STATUS_LIKE = 1;
    const STATUS_DISLIKE = 2;
    const STATUS = [
        self::STATUS_NONE,
        self::STATUS_LIKE,
        self::STATUS_DISLIKE,
    ];

    const MODEL_TYPE=[
        Post::class
    ];

    protected $fillable = [
        'status',
        'model_id',
        'model_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => __('administration')]);
    }

    public function model()
    {
        return $this->morphTo();
    }

    //---------------------- other functions ---------------

    public static function selectStatusList()
    {
        return [
            self::STATUS_NONE => __('canceled'),
            self::STATUS_LIKE => __('liked'),
            self::STATUS_DISLIKE => __('disliked'),
        ];
    }

}
