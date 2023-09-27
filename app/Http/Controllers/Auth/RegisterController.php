<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'username' => 'required|alpha_num|unique:users|min:6|max:35',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        if(!$user){
            return redirect('/register')->with('register-error', 'Error al intentar registrar el usuario.');
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            event(new Registered($user));
            $request->session()->regenerate();
            return redirect()->route('verification.notice');
        }

        return redirect('/login')->with('register-success', 'Usuario registrado exitosamente, para poder acceder debes verificar tu cuenta revisando el correo que te hemos enviado.');
    }
}
