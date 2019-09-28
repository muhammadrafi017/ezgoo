<?php

use Illuminate\Database\Seeder;

class TrainFareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\TrainFare::class, 10)->create();
    }
}
