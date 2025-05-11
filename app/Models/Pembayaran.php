<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'transaksi_id',
        'snap_token',
        'expired_at',
        'paid_at',
        'status',
    ];
}
