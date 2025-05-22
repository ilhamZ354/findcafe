<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'cafe_id', 'name', 'image', 'type', 'description', 'harga'
    ];

    public function cafeDetail(): BelongsTo
    {
        return $this->belongsTo(CafeDetail::class, 'cafe_id', 'cafe_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'cafe_id');
    }

}
