<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasCaching
{
    public static function getAllCached()
    {
        return Cache::remember(static::class, 3600 * 24, fn () => static::class::all());
    }

    public static function bootHasCaching(): void
    {
        static::saved(function () {
            Cache::forget(static::class);
        });
        static::deleted(function () {
            Cache::forget(static::class);
        });
    }
}
