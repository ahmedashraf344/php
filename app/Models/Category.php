<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes, ColumnAccessor, ColumnTranslation;

    protected $fillable = [
        'name_ar',
        'name_en',
        'category_id',
        'feature_image',
        'views',
    ];

    protected $appends = [];

    public function subCategories()
    {
        return $this->hasMany(Category::class);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    //------------------ accessor and mutator --------------

    public function getFeatureImageAttribute($value)
    {
        return (($value != null) || (Storage::exists($value))) ? asset($value) : null;
    }

}
