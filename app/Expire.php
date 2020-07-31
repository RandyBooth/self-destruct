<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Expire extends Model
{
    protected $casts = [
        'hour' => 'integer',
    ];

    protected $fillable = [
        'name',
        'hour'
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('hour', 'asc');
        });
    }

    public static function cached()
    {
        return cache()->rememberForever(
            'expires',
            function () {
                return static::all();
            }
        );
    }

    public static function plucked()
    {
        return cache()->rememberForever(
            'expires_plucked',
            function () {
                return static::cached()->pluck('name', 'hour')->all();
            }
        );
    }
}
