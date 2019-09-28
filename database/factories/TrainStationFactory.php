<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TrainStation::class, function (Faker $faker) {
    return [
        'code' => str_random(5),
        'city' => $faker->city,
        'station_name' => $faker->city." Station",
    ];
});
