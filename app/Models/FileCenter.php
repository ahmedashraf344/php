<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileCenter extends Model
{
    protected $fillable=[
        'model_id',
        'model_type',
        'file',
        'extension',
        'name',
        'user_id'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //------------------ accessor and mutator --------------

    public function getFileAttribute($value)
    {
        return (($value != null) || (Storage::exists($value))) ? asset($value) : null;
    }
}
