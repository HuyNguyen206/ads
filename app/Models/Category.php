<?php

namespace App\Models;

use App\Models\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, CreateSlug;
    protected static $unguarded = true;

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeRootParent(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeSubCategories(Builder $builder)
    {
        $builder->whereNotNull('parent_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
