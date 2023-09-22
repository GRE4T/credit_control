<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SessionAudit;
use App\Models\SocialProfile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

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
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1,
        ])){
            $request->session()->regenerate();

            SessionAudit::create([
                'user_id' => Auth::id(),
                'type_session' => 'Login',
                'ip_address' => $request->ip()
            ]);

            return  redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        SessionAudit::create([
            'user_id' => $request->user()->id,
            'type_session' => 'Logout',
            'ip_address' => $request->ip()
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
