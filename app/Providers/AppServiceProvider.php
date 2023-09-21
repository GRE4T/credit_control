<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        VerifyEmail::$toMailCallback = function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificación de correo electrónico')
                ->view('emails.verifyEmail', [
                    'url' => $url,
                    'user' => $notifiable
                ]);
        };
    }
}
