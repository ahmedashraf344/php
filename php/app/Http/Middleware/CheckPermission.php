<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controllerName = class_basename(Route::current()->controller);
        $perm = strtolower(substr($controllerName, 0, -10));

        /*        $specialCaseControllers = ['MeetingAnnouncementController', 'MeetingResolutionController',
                    'CalenderController', 'AdvancedSearchController', 'TagsController', 'AuthNotificationsController',
                    'NotificationCenterController','SubShareholderController'];
                if (in_array($controllerName, $specialCaseControllers)) {
                    return $next($request);
                }*/

        /*        if ($perm == 'disclosuresigned' && !(auth()->user()->hasRole(Role::DEFAULT_ROLE_SECRETARY) ||
                        auth()->user()->hasRole(Role::DEFAULT_ROLE_SUPERADMIN))) {
                    return abort(403);
                }
                if ($perm == 'disclosureuser' && !auth()->user()->hasRole(Role::DEFAULT_ROLE_MEMBER)) {
                    return abort(403);
                }

                if (in_array($perm, ['secretary', 'member', 'admin'])) $perm = 'user';
                if ($perm == 'meetingannouncement') $perm = 'announcement';
                if ($perm == 'meetingresolution') $perm = 'resolution';
                if ($perm == 'disclosuresetting') $perm = 'disclosure';
                if ($perm == 'disclosuresigned') $perm = 'disclosureuser';
                if ($perm == 'notificationsetting') $perm = 'setting';*/

        $action = Route::getCurrentRoute()->getActionMethod();

        $allowed = ['index', 'create', 'destroy', 'edit', 'show'];
        if (!in_array($action, $allowed)) {
            return $next($request);
        }

        $action = $action == 'index' ? 'View' : $action;
        $action = $action == 'create' ? 'Add' : $action;
        $action = $action == 'destroy' ? 'Delete' : $action;
        $action = $action == 'edit' ? 'Edit' : $action;
        $action = $action == 'show' ? 'View' : $action;
        $permission = ($perm == 'report' ? 'View' . ' ' . $perm : $action . ' ' . $perm);

        if ((!Permission::where('name', $permission)->exists() || !Auth::user()->can($permission))) {
            if ($perm == 'home') return $next($request);
            return abort(403);
        }

        return $next($request);
    }
}
