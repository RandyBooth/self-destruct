<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'body' => $faker->text(200),
        'password' => bcrypt(1),
        'expired_at' => now()->days(1),
    ];
});
