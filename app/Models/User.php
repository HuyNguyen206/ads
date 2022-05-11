<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ads()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class, 'user_id');
    }

    public function getAvatarFromSocial()
    {
        $providers = $this->socialProviders()->get(['provider'])->pluck('provider')->toArray();
        foreach ($providers as $provider) {
            if ($avatar = $this->getFirstMediaUrl("avatar.$provider")){
                return $avatar;
            }
        }
    }

    public function getAvatar()
    {
        if ($url = $this->getFirstMediaUrl('avatar')) {
            return $url;
        }
        $providers = $this->socialProviders()->get(['provider'])->pluck('provider')->toArray();
        foreach ($providers as $provider) {
            if ($avatar = $this->getFirstMediaUrl("avatar.$provider")){
                return $avatar;
            }
        }
    }

    public function savedAdvertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'saved_ads', 'user_id', 'ad_id');
    }

    public function isAlreadySaveThisAd($adId)
    {
        return $this->savedAdvertisements()->where('advertisements.id', $adId)->exists();
    }
}
