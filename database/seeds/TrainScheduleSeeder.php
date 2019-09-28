<?php

use Illuminate\Database\Seeder;

class TrainScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\TrainSchedule::class, 20)->create();
    }
}
