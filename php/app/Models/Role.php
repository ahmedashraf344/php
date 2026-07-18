<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends \Spatie\Permission\Models\Role
{
    use LogsActivity;

    const ROLE_SUPER_ADMIN='super-admin';

    protected $appends = ['is_superadmin','is_secretary','is_member'];

    // Log activity configuration
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'role';

}
