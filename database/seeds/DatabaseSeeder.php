<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BankSeeder::class);

        //Train Seeder
        $this->call(TrainTableSeeder::class);
        $this->call(TrainStationTableSeeder::class);
        $this->call(TrainFareSeeder::class);
        $this->call(TrainScheduleSeeder::class);

        //Plane Seeder
        $this->call(PlaneSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(PlaneFareSeeder::class);
        $this->call(PlaneScheduleSeeder::class);

        //Booking
        //$this->call(BookingSeeder::class);


    }
}
