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

    /**
     * Redirect the user to the Drive authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($drive)
    {
        $drivers = ['facebook','google'];
        if(in_array($drive, $drivers))
            return Socialite::driver($drive)->redirect();
        else
            return redirect()->route('login');
    }

     /**
     * Obtain the user information from Drive.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $drive)
    {
        
        try{
            //Valido si el usuario preciona en cancelar.
            if($request->get('error'))
                throw new Exception('Ocurrio un error al cancelar desde facebook o google.');

            $userSocialite = Socialite::driver($drive)->user();
            
            //valida si el usuario se logeo con una red social anteriormente
            $socialProfile = SocialProfile::where('social_id', $userSocialite->getId())
                    ->where('social_name', $drive)->first();
                
            if(!$socialProfile){

                //valida si el usuario esta registrado
                $user = User::where('email', $userSocialite->getEmail())->first();
                if(!$user){
                    //Registra el usuario.
                    $user = new User();
                    $user->name = $userSocialite->getName();
                    $user->email = $userSocialite->getEmail();
                    $user->username = $userSocialite->getEmail();
                    $user->password = Hash::make('password');
                    $user->role_id = 'ROLE_USER';
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                }

                $socialProfile = SocialProfile::create([
                    'user_id' => $user->id,
                    'social_id' => $userSocialite->getId(),
                    'social_name' => $drive,
                    'social_avatar' => $userSocialite->getAvatar()
                ]);
            }

            
            auth()->login($socialProfile->user); //inicia sesión del usuario.

            $request->session()->regenerate();
            SessionAudit::create([
                'user_id' => Auth::id(),
                'type_session' => 'Login',
                'ip_address' => $request->ip()
            ]);

            return  redirect()->intended('/');

        } catch(Exception $e){
            $errors = [
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ];
            //print_r($errors); exit;
            return  redirect()->route('login');
        } 
    }
}
