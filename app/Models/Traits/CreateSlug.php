<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait CreateSlug
{
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function test()
    {

    }
}
