<?php

namespace App\Http\Controllers\Api\Auth;

//use App\Http\Controllers\Api\Controller as Controller;
//use App\Http\Controllers\Api\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Patient;


//use JWTAuth;
//use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    var $lolo='Vacio';
//    public function __construct()
//    {
////        auth()->setDefaultDriver('patient');
//        $this->lolo= 'Energia Cosmica';
////        $this->middleware('checkAuth');
//    }

    public function __construct()
    {
        parent::__construct();
        $this->middleware('checkAuth')->except('login');
    }

    public function login(Request $request)
    {
//        return response()->json('energia', 201);
//        return $request->get('email');
//        return $request->get('code');

//        $creds = $request->only(['name', 'password']);
//        $token = auth()->claims(['foo' => 'bar'])->attempt($creds);

//        $creds = $request->only(['id']);
//        $token= auth()->tokenById($creds);

//        $user = Admin::first();
//        $token = auth()->claims(['foo' => $user->email])->login($user);

//        $credentials = $request->only(['email', 'password']);
//        $token = auth('admin')->attempt($credentials);

        $user = Patient::where('code', $request->get('code'))->get()[0];
        $token = auth('patient')->claims(['foo' => $user->email])->login($user);
        return $token;
//        $user = Patient::first();
//        return $user;
//
    }

    public function check(Request $request)
    {
//        return $request->get('usuario');
        $credentials = $request->get('token');
//        return $credentials;
//        $token = auth('admin')->attempt($credentials);


//        if(auth('patient')->validate($credentials)){
//            return 'Exito';
//        }else{
//            return 'Nel';
//        }

        return response()->json(auth('patient')->user());
    }

    public function getUser(Request $request)
    {
        // Funciona, solo manda el token en el body, header o en la url directamente
        $user= $request->get('usuario');
        try {
            return response()->json($user, 201);;
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        }

        // Funciona
//        $user = Patient::first();
//
//        $token = JWTAuth::fromUser($user);
//        return $token;
    }

    public function getPayload(Request $request)
    {
//        return response()->json('Batman who laughts', 201);
        $payload = auth('patient')->payload();
        return $payload;
    }
}
