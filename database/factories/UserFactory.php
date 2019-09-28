<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
  $array = ['A'=> "Tuan",'B'=>"Nyonya",'C'=>"Nona"];
  $rnd = array_rand($array);
    return [
        'name' => $faker->name,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => $array[$rnd],
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'verified' => 1,
        'remember_token' => str_random(10),
        'verification_token' => hash_hmac('sha256', Str::random(40), config('app.key')),
    ];
});
