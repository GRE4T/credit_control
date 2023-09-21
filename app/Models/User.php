<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['is_admin'];

    public function getIsAdminAttribute()
    {
        return $this->attributes['role_id'] == 'ROLE_ADMIN';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = route('password.reset', $token);

        $this->notify(new ResetPasswordNotification($url));

    }

    public function sessionAudits()
    {
        return $this->hasMany(SessionAudit::class);
    }

    public function lastConnection()
    {
        $connection = $this->sessionAudits()->where('type_session', 'Login')->orderBy('id','desc')->first();
        
        if($connection){

            $date = Carbon::parse($connection->created_at);

            return ucfirst($date->isoFormat('dddd\ D \d\e MMMM \d\e\l Y'));

        }

        return;
    }

    public function socialProfiles(){
        return $this->hasMany(SocialProfile::class);
    }
}
