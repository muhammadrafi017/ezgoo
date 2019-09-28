<?php

use Faker\Generator as Faker;
use App\Models\Plane;
use App\Models\Airport;
use Carbon\Carbon;

$factory->define(App\Models\PlaneSchedule::class, function (Faker $faker) {
DB::table('plane_schedules')->delete();

    a:
    $nums = Airport::all()->count();
    $numssss = Plane::all()->count();
    $rnd = rand(1,$numssss);
    $plane = Plane::find($rnd);
    $num1 = rand(1,$nums);
    $num2 = rand(1,$nums);
    $firstAirport = Airport::find($num1);
    $lastAirport = Airport::find($num2);
    $w = rand(1,7);
    $d = rand(1,28);
    $date = Carbon::create(2018,5,1)->addWeeks($w)->addDays($d);

    if ($lastAirport == $firstAirport) {
      goto a;
    }

    return [
        'airport_id' => $firstAirport->id,
        'plane_id' => $plane->id,
        'destination' => $lastAirport->airport_name,
        'destination_code' =>$lastAirport->code,
        'from' => $firstAirport->airport_name,
        'from_code' => $firstAirport->code,
        'boarding_time' => date('Y-m-d H:i:s', strtotime($date.'+ 1 days')),
        'duration' => rand(1,99),
        'gate' => rand(1,99),
        'eco_seat' => rand(1,10),
        'bus_seat' => rand(1,10),
        'first_seat' => rand(1,10),
    ];
});
