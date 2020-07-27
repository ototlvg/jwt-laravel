<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
//use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Exceptions\TokenExpiredException;
//use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
        // Version que lanza los errores correctos, pero toma solamente el id del token y busca en la tabla especificada por el registro que coincida con el id, sin importarle si el token se genero a partir de esa tabla o no - NEcesita esto use Tymon\JWTAuth\Facades\JWTAuth;
//        auth()->setDefaultDriver('admin');
//        $user = JWTAuth::parseToken()->authenticate();
//        return response()->json($user,201);

        // Version que funciona correctamente, pero si hay error en el token no es capaz de reconocer cual tipo de error es, solo que hay un error (Depende de Handler.php)
        $user = auth('admin')->userOrFail();
        $request->attributes->add(['usuario' => $user]);
        return $next($request);
//        return response()->json($user,201);


//        try {
//            $user = auth('patient')->userOrFail();
//            $request->attributes->add(['usuario' => $user]);
//            return $next($request);
//        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
////            return response()->json(['error' => $e->getMessage()]);
//            return response()->json(['error' => $e->getMessage()]);
//        }

//        try {
//            auth()->setDefaultDriver('patient');
//            $user = JWTAuth::parseToken()->authenticate();
//            return response()->json($user,201);;
//        }catch (TokenExpiredException $e){
//            return response()->json(['error' => 'Token is expired'],400);
//        }catch (TokenInvalidException $e){
//            return response()->json(['error' => 'Token is Invalid'],400);
//        }catch (JWTException $e){
//            return response()->json(['error' => 'Generic JWT Error'],400);
//        }
    }
}
