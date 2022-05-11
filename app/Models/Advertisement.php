<?php

namespace App\Models;

use App\Models\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Advertisement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, CreateSlug, HasEagerLimit ;

    protected static $unguarded = true;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'none'
        ]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault([
            'name' => 'none'
        ]);
    }

    public function state()
    {
        return $this->belongsTo(State::class)->withDefault([
            'name' => 'none'
        ]);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault([
            'name' => 'none'
        ]);
    }

    public function savedUsers()
    {
        return $this->belongsToMany(User::class, 'saved_ads', 'ad_id', 'user_id');
    }

}
