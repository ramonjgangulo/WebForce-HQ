<?php

namespace App\Http\Controllers\Auth;

use App\ExternalAPI\Comunicador;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginAttempt(Request $request)
    {
        $creds = $request->all();
        $token = auth()->attempt($request->all());
        if(!$token = auth()->attempt($creds))
        {
            return response()->json(['error' => 'email or password are invalid'],401);
        }

        return response()->json(['token' => $token]);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['mensaje' => 'Hasta la próxima!'],200);
    }
}
