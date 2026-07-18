<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'date',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => __('administration')]);
    }

}
