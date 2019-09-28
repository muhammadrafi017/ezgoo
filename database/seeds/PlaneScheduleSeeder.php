<?php

use Illuminate\Database\Seeder;

class PlaneScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\PlaneSchedule::class, 20)->create();
    }
}
