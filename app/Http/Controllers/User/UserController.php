<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $client;

    public function __construct()
    {
        //para cuando usamos url diferentes
        $this->client = new Client(['base_uri' => env('APP_URL')]);
    }
    public function index()
    {
        return view('welcome');
    }
    public function loginv2(LoginRequest $request)
    {
        //recupero el correo y la contraseña excepto el token csrf
        $credenciales = request()->only('email', 'password');
        //consumo api login
        $login = login_user($credenciales);
        //veriifco si no hay error
        if (!is_array($login)) {
            session()->flash('swal', [
                'icon' => 'error',
                'text' => 'Error en token jwt',
                'title' =>  '!Ocurrió un error!'
            ]);
        }
        //verifico el resultado 
        if (!filter_var($login["estado"], FILTER_VALIDATE_BOOLEAN)) {
            session()->flash('swal', [
                'icon' => 'warning',
                'text' => 'Usuario o contraseña incorrecta',
                'title' =>  '!Usuario no identificado!'
            ]);
        }
        //creo session con el token de jwt
        session(['token_web' => $login["token"]]);

        return redirect()->back();
    }
    public function logoutv2(Request $request)
    {
        //consumo api de logout
        $logout = logout_user();
        return redirect(route('home'));
    }
}
