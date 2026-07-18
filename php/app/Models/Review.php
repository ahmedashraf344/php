<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'shop_id',
        'user_id',
        'rate',
        'comment',
    ];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
