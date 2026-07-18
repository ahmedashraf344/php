<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected static $abilities;

    protected static $models;

    protected static $permissions;

    public static function defaultPermissions()
    {
        self::$permissions = [];

        self::$abilities = collect(['view', 'add', 'edit', 'delete']);

        $files = Storage::disk('app')->files('Models');
        self::$models =  collect($files)->map(function ($file) {
            return basename($file, '.php');
        });

        self::$models->map(function ($model) {
            self::$abilities->map(function ($ability) use ($model) {
                $perm = Str::ucfirst($ability) . ' ' . (Str::lower($model));
                self::$permissions[] = ['name'=>$perm,'model'=>Str::lower($model)];
            });
        });

        return self::$permissions;
    }
}
