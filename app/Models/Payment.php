<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected  $fillable = [
        'agreement_id',
        'headquarter_id',
        'credit_number',
        'credit_pos_number',
        'receipt_number',
        'value'
    ];

    public function agreement(){
        return $this->belongsTo(Agreement::class);
    }

    public function headquarter(){
        return $this->belongsTo(Headquarter::class);
    }
}
