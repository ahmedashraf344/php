<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return json_response(null, null,
                    401, ['exception' => collect(__('invalid token'))]);
            } else if ($e instanceof TokenExpiredException) {
                return json_response(null, null,
                    401, ['exception' => collect(__('expired token'))]);
            } else {
                return json_response(null, null,
                    401, ['exception' => collect(__('Authorization token not found'))]);
            }
        }

        return $next($request);
    }
}
