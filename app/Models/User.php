<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'otp_expires_at',
        'is_verified',
        'avatar_url',
        'status',
        'role',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp'
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
            'email_verified_at' => 'datetime',
            'otp_expired_at' => 'datetime',
            'password' => 'hashed',

        ];
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function pushTokens()
    {
        return $this->hasMany(PushToken::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessors
    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    public function isOtpValid(string $otp): bool
    {
        return $this->otp && Hash::check($otp, $this->otp)
            && $this->otp_expired_at
            && $this->otp_expired_at->isFuture() ?? false;
    }

    public function isVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    public function markAsVerified(): void
    {
        $this->email_verified_at = now()->toDateTimeString();
        $this->otp = null;
        $this->otp_expired_at = null;
        $this->save();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public  function isSuperAdmin(): bool
    {
        return  $this->role == 'superAdmin';
    }
}
