<?php

use Illuminate\Database\Seeder;

class TrainStationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\TrainStation::class, 2)->create();
    }
}
