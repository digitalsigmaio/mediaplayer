<?php

use Faker\Generator as Faker;

$factory->define(App\Album::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'year' => $faker->year,
        'image' => $faker->imageUrl(640, 480),
    ];
});
