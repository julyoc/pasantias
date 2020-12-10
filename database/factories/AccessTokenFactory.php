<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AccessToken;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(AccessToken::class, function (Faker $faker) {
    return [
        'token' => $faker->name,
    ];
});