<?php

namespace App;

use App\Observers\MessageObserver;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use betterapp\LaravelDbEncrypter\Traits\EncryptableDbAttribute;

class Message extends Model
{
    use EncryptableDbAttribute;

    protected $dates = [
        'expired_at',
    ];

    protected $encryptable = [
        'slug_password',
        'body',
    ];

    protected $fillable = [
        'body',
        'password',
        'expired_at',
    ];

    protected $hidden = [
        'slug_password',
        'password',
    ];

    protected static function booted()
    {
        static::addGlobalScope(
            'expired',
            function (Builder $builder) {
                $builder
                    ->where('expired_at', '>', now())
                    ->orWhereNull('expired_at');
            }
        );

        static::observe(MessageObserver::class);
    }

    public function scopeSlug($query, $slug)
    {
        return $query->whereRaw("BINARY slug = ?", [$slug]);
    }

    public function checkSlugPassword($password1, $password2)
    {
        return $password1 === $password2;
    }
}
