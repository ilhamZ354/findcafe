<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'cafe_id', 'name', 'image', 'type', 'description', 'harga'
    ];

    // rlasi ke cafe detail
    public function cafeDetail(): BelongsTo
    {
        return $this->belongsTo(CafeDetail::class, 'cafe_id');
    }
}
