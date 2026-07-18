<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{

    use SoftDeletes, ColumnAccessor;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $table = 'competitions';

    protected $fillable = [
        'user_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'min_number',
        'max_number',
        'active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'competitions_users', 'competition_id', 'user_id')->withPivot('id' ,'number', 'created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
