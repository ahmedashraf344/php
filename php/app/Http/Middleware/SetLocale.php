<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class SetLocale
{
    // ...
    private $locales = ['ar', 'en'];

    // ...
    public function handle($request, Closure $next)
    {

        if ($request->server('HTTP_ACCEPT_LANGUAGE') == 'en'){
            $locale = 'en';
            session()->put('lang','en');
        }elseif ($request->server('HTTP_ACCEPT_LANGUAGE') == 'ar'){
            $locale = 'ar';
            session()->put('lang','ar');
        }else{
            $locale = $request->route('lang');
        }

        if($locale || session()->has('lang')){
            app()->setLocale(session()->get('lang'));
        }
        else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
