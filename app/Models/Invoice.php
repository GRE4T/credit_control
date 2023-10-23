<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected  $fillable = [
        'agreement_id',
        'headquarter_id',
        'invoice_pos_number',
        'invoice_agreement',
        'value',
        'detail',
        'expiration_date'
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

    public function state()
    {
        return $this->belongsTo(InvoiceState::class, 'invoice_state_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
