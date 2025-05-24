<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CafeDetail;
use App\Models\RatingReview;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'role',
        'no_wa',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // realasi ke cafe detail
    public function cafeDetail(): HasOne
    {
        return $this->hasOne(CafeDetail::class, 'cafe_id');
    }

    // relasi ke menus
    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    // relasi ke rating review
    public function ratingReviews(): HasMany
    {
        return $this->hasMany(RatingReview::class);
    }

    // relasi ke transaction
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // relasi ke bookmarks
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    // relasi ke unread messages
    public function unreadMessages()
    {
        return $this->hasMany(Chat::class, 'from_user_id', 'id')
            ->where('is_read', false);
    }
}
