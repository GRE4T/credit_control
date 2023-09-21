<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id',
        'client_id',
        'server_id',
        'domain',
        'website',
        'authorization_code',
        'annual_price',
        'expiration_date',
        'host_FTP',
        'user_FTP',
        'password_FTP',
        'port_FTP',
        'client_FTP',
        'observations'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
