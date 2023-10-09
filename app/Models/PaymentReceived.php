<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentReceived extends Model
{
    use HasFactory;

    protected $table = 'payments_received';

    protected  $fillable = [
        'agreement_id',
        'headquarter_id',
        'receipt_number',
        'value',
        'type_payment',
    ];

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    public function headquarter(){
        return $this->belongsTo(Headquarter::class);
    }
}

