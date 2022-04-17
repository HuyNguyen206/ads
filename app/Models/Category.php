<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected static $unguarded = true;

    protected static function booted()
    {
            static::creating(function (Category $category){
                $category->slug = Str::slug($category->name);
            });

            static::updating(function (Category $category){
                $category->slug = Str::slug($category->name);
            });
    }

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
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
