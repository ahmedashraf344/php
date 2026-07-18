<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;

class Shop extends Model
{
    use  SoftDeletes, ColumnAccessor, ColumnTranslation;

    const SHOP_FILTERS = [
        'nearest',
        'rate_desc'
    ];
    const STATUS_DISABLED = 2;
    const STATUS_PUBLISHED = 1;
    const STATUS_IN_REVIEW = 0;
    const STATUS = [
        self::STATUS_DISABLED,
        self::STATUS_IN_REVIEW,
        self::STATUS_PUBLISHED,
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'feature_image',
        'category_id',
        'mobile_1',
        'mobile_2',
        'phone_1',
        'phone_2',
        'hotline',
        'address_ar',
        'address_en',
        'latitude',
        'longitude',
        'facebook',
        'instagram',
        'user_id',
        'working_days_ar',
        'working_days_en',
        'start_at',
        'end_at',
        'views',
        'status',
        'status_reason',
        'comments'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name'=>__('administration')]);
    }

    public function gallery()
    {
        return $this->morphMany(FileCenter::class, 'model');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderByDesc('updated_at');
    }

    public function rates()
    {
        return $this->hasMany(Review::class)->orderByDesc('updated_at');
    }

    public function existsInFavourite()
    {
        return $this->hasOne(Favourite::class)->where('user_id',auth()->id());
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'model')/*->orderByDesc('id')*/;
    }

    public function publishedComments()
    {
        return $this->comments()->where('status', self::STATUS_PUBLISHED)->where('uuid_status' , 1);
    }

    public function publishedCommentsOrderedDesc()
    {
        return $this->publishedComments()->orderByDesc('id');
    }

    //------------------ accessor and mutator --------------

    public function getFeatureImageAttribute($value)
    {
        return (($value != null) || (Storage::exists($value))) ? asset($value) : null;
    }

    public function getWorkingDaysAttribute()
    {
        if ((app()->getLocale() == 'ar') || ($this['working_days_en'] == null)) {
            return $this['working_days_ar'];
        } else {
            return $this['working_days_en'];
        }
    }

    //---------------------- other functions ---------------

    public static function selectStatusList()
    {
        return [
            self::STATUS_IN_REVIEW => __('In Review'),
            self::STATUS_PUBLISHED => __('Published'),
            self::STATUS_DISABLED => __('Disabled'),
        ];
    }

}
