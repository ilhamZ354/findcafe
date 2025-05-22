<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'cafe_id',
        'user_id',
        'transaksi_id',
        'name',
        'catatan',
        'nominal',
        'tgl_booking',
        'status'
    ];

    protected $casts = [
        'tgl_booking' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }

    public function payments()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
