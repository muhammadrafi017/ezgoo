<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Plane::class, function (Faker $faker) {
    return [
        //
        'plane_name' => "Plane ".$faker->firstName,
        'eco_seat' => rand(1,20),
        'bus_seat' => rand(1,20),
        'first_seat' => rand(1,20),
    ];
});
