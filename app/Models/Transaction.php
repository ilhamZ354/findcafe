<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'cafe_id', 'user_id', 'name', 'catatan', 'nominal', 'tgl_booking', 'status', 'snap_token'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }
}
