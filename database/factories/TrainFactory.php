<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Train::class, function (Faker $faker) {
    return [
        'train_name' => "Agro ".$faker->firstName,
        'eco_seat' => rand(1,20),
        'bus_seat' => rand(1,20),
        'exec_seat' => rand(1,20),
    ];
});
