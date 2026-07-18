<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use  SoftDeletes, ColumnTranslation;

    const STATUS_PUBLISHED = 1;
    const STATUS_IN_REVIEW = 0;
    const STATUS = [
        self::STATUS_IN_REVIEW,
        self::STATUS_PUBLISHED,
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'content_ar',
        'content_en',
        'user_id',
        'status',
        'views',
        'comments',
        'likes',
        'dislikes',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => __('administration')]);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'model')/*->orderByDesc('id')*/;
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'model')/*->orderByDesc('id')*/;
    }

    public function authReaction()
    {
        return $this->reactions()->where('user_id',auth()->id())->first();
    }

    public function likes()
    {
        return $this->reactions()->where('status', Reaction::STATUS_LIKE);
    }

    public function dislikes()
    {
        return $this->reactions()->where('status', Reaction::STATUS_DISLIKE);
    }

    public function publishedComments()
    {
        return $this->comments()->where('status', self::STATUS_PUBLISHED)->where('uuid_status', 1);
    }

    public function publishedCommentsOrderedDesc()
    {
        return $this->publishedComments()->orderByDesc('id');
    }

    //------------------ accessor and mutator --------------

    public function getImageAttribute($value)
    {
        return (($value != null) || (Storage::exists($value))) ? asset($value) : null;
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
