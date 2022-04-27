<?php

namespace App\Models;

use App\Models\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Advertisement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, CreateSlug;

    protected static $unguarded = true;

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
