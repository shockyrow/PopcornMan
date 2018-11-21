<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName.' '.$faker->lastName,
        'imgUrl' => '',
        'about' => $faker->realText(512),
        'year' => $faker->numberBetween(1980, 2018),
    ];
});
