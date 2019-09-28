<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Booking::class, function (Faker $faker) {
  $cs = App\Models\User::all();
  $sch = App\Models\TrainSchedule::all();
  $csid = $cs->count();
  $schid = $sch->count();
  $cd = rand(0,1);
  $type = array("Kereta","Pesawat");

    return [
        //
        'user_id' => rand(1,$csid),
        'booking_date' => date('Y-m-d H:i:s'),
        'status' => $cd,
        'type' => $type[$cd],
        'schedule_id' => rand(1,$schid),
    ];
});
