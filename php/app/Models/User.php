<?php

namespace App\Models;

use App\Traits\ColumnAccessor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles, SoftDeletes,ColumnAccessor;

    const VERIFICATION_STATUS_PENDING=0;
    const VERIFICATION_STATUS_DONE=1;
    const VERIFICATION_STATUS=[
        self::VERIFICATION_STATUS_PENDING,
        self::VERIFICATION_STATUS_DONE,
    ];

    const MAIN_ACCOUNTS_IDS=[
        1
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'avatar',
        'ip_address',
        'mac_address',
        'device_id',
        'device_token',
        'code',
        'forget_code',
        'verification_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    public function files()
    {
        return $this->hasMany(FileCenter::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favourite()
    {
        return $this->hasMany(Favourite::class)->orderByDesc('id');
    }

    // ------------ accessor and mutators ---------

    public function getCustomAvatarAttribute($value)
    {
        if (($value == null) || (!Storage::exists(replace_storage_folder($value)))) {
            $value = 'admin/img/avatar.png';
        }

        return asset($value);
    }

    // public function getVerificationStatusAttribute($value)
    // {
    //    return ($value == self::VERIFICATION_STATUS_DONE) ? 'verified' : 'not verified yet';
    // }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    //---------------- custom functions -------------

    public static function checkCodeExists($code)
    {
        return self::whereCode($code)->first();
    }

    public static function generateCode()
    {
        // $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $charactersLength = strlen($characters);
        // $randomString = '';
        // for ($i = 0; $i < 4; $i++) {
        //     $randomString .= $characters[rand(0, $charactersLength - 1)];
        // }
        // $code = $randomString . '_' . (substr(mt_rand(), 0, 4));
        // $check = self::checkCodeExists($code);
        // if ($check) {
        //     return self::generateCode();
        // } else {
        //     return $code;
        // }
        return mt_rand(1000 , 9999);
    }

    // --------------- jwt -------------------------

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function competitions()
    {
        return $this->belongsToMany( Competition::class, 'competitions_users','user_id', 'competition_id')->withPivot('number', 'created_at');
    }

    public function uuid()
    {
        return $this->hasOne(UsersUuids::class , 'user_id');
    }

}
