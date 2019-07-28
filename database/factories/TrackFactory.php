<?php

use Faker\Generator as Faker;

$factory->define(App\Track::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'url' => $faker->url,
        'ringtone_url' => $faker->url,
        'vodafone' => $faker->numberBetween(10000,19999),
        'orange' => $faker->numberBetween(10000,19999),
        'etisalat' => $faker->numberBetween(10000,19999),
    ];
});
