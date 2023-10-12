<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMade extends Model
{
    use HasFactory;

    protected $table = 'payments_made';

    protected  $fillable = [
        'agreement_id',
        'headquarter_id',
        'receipt_number',
        'value',
        'type_payment',
        'detail',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    public function headquarter(){
        return $this->belongsTo(Headquarter::class);
    }
}
