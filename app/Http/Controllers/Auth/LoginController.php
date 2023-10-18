<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'username' => ['required','string', 'exists:users,username'],
            'password' => ['required']
        ]);

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'active' => '1'
        ])){
            $request->session()->regenerate();

            return  redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Credenciales incorrectas'
        ])->onlyInput('password');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
