<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->hasRole(Role::ROLE_SUPER_ADMIN)){
            auth()->logout();
            alert(__('please login with admin account'));
            return redirect(route('login'));
        }
        return $next($request);
    }
}
