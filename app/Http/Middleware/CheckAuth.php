<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
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
        try {
            $user = auth('patient')->userOrFail();

            $request->attributes->add(['usuario' => $user]);
            return $next($request);
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
