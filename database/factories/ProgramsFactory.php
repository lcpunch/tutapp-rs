<?php

use Faker\Generator as Faker;

$factory->define(App\Program::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->paragraph,
    ];
});