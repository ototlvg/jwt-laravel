<?php

namespace App\Http\Middleware;

use Closure;

class CheckCookie
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
//        return response()->json('Energia', 201);
        $value = $request->cookie('jwt');
        if(empty($value)){
            return response()->json('Vacio', 201);
        }
//        return response()->json($value, 201);
        $request->headers->set('Authorization', 'Bearer '.$value);
//        return response()->json($request->get('token'), 201);
        return $next($request);
    }
}
