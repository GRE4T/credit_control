<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest as RequestsEmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function verificationEmail(){
        return Auth::user()->email_verified_at ? redirect()->back() : view('auth.verify');
    }

    public function verificationVerify(RequestsEmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/home');
    }

    public function verificationSend(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Enlace de verificación enviado');
    }
}
