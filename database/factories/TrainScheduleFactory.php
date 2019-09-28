<?php

use Faker\Generator as Faker;
use App\Models\Train;
use App\Models\TrainStation;
use Carbon\Carbon;


$factory->define(App\Models\TrainSchedule::class, function (Faker $faker) {
  a:
  $nums = TrainStation::all()->count();
  $numssss = Train::all()->count();
  $rnd = rand(1,$numssss);
  $train = Train::find($rnd);
  $num1 = rand(1,$nums);
  $num2 = rand(1,$nums);
  $firstStation = TrainStation::find($num1);
  $lastStation = TrainStation::find($num2);
  $dur = rand(1000, 2000);
  $w = rand(1,7);
  $d = rand(1,28);
  $date = Carbon::create(2018,5,1)->addWeeks($w)->addDays($d);

  if ($firstStation == $lastStation) {
    goto a;
  }
    return [
        'station_id' => $firstStation->id,
        'train_id' => $train->id,
        'from' => $firstStation->station_name,
        'from_code' => $firstStation->code,
        'destination' => $lastStation->station_name,
        'duration' => $dur,
        'destination_code' =>$lastStation->code,
        'eco_seat' => rand(1,10),
        'bus_seat' => rand(1,10),
        'exec_seat' => rand(1,10),
        'platform' => rand(1,99),
        'boarding_time' => $date,
    ];
});
