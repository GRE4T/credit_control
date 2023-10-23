<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function paymentsMade(){
        return $this->hasMany(PaymentMade::class);
    }

    public  function paymentsReceived(){
        return $this->hasMany(PaymentReceived::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
