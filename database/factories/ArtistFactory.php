<?php

use Faker\Generator as Faker;

$factory->define(App\Artist::class, function (Faker $faker) {
    return [
        'name' => 'Artist Name',
        'about' => 'Artist About',
        'image' => '',
    ];
});
