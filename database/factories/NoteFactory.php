<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'body' => $faker->text(200),
        'password' => bcrypt('password'),
        'expired_at' => now()->days(1),
    ];
});
