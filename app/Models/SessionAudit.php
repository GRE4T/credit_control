<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_session',
        'ip_address'
    ];
    
}
