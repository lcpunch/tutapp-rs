<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->languageCode,
        'program_id' => $faker->numberBetween(0, 39),
    ];
});
