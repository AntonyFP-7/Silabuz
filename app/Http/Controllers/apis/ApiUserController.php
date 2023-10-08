<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ApiUserController extends Controller
{
    public function generarToken()
    {

        //* CREAMOS TOKEN
        $factory = JWTFactory::customClaims([
            'sub' => env('APP_KEY'),
        ]);
        $payload = $factory->make();
        $token = JWTAuth::encode($payload);
        /* ----------------- */
        //creo session con el token de jwt
        session(['token_web' => $token->get()]);
        return response()->json(array(
            "token" => true,
        ));
    }
    public function login(Request $request)
    {
        //agrego validaciones para emial y contraseña
        $validaciones = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico valido.',
            'password.required' => 'Debes ingresar tu contraseña'
        ]);
        //envio si hay un error
        if ($validaciones->fails()) {
            return response($validaciones->errors(), 400);
        }
        //recupero el correo y la contraseña excepto el token csrf
        $credenciales = request()->only('email', 'password');
        if (Auth::attempt($credenciales)) {
            //* CREAMOS TOKEN
            $factory = JWTFactory::customClaims([
                'sub' => env('APP_KEY'),
            ]);
            $payload = $factory->make();
            $token = JWTAuth::encode($payload);

            return  response()->json(['estado' => 1, "token" => $token->get()], 200);
        }
        return  response()->json(['estado' => 0], 200);
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('token_web');
        session()->flush();
        session()->invalidate();
        session()->regenerateToken();
        return  response()->json(['estado' => 1], 200);
    }
}
