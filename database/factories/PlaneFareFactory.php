<?php

use Faker\Generator as Faker;
use App\Models\Plane;

$factory->define(App\Models\PlaneFare::class, function (Faker $faker) {
  static $num = 1;
  $unique = mt_rand(1,999);
  $plane = Plane::find($num);
  $num++;
  $array = ['A'=> 5000,'B'=>10000,'C'=>15000];
  $abc = array_rand($array);
  $price = $array[$abc];

    return [
        //
        'plane_id' => $plane->id,
        'eco_seat' => $price,
        'bus_seat' => $price,
        'first_seat' => $price,
        'unique_code' => $unique
    ];
});
