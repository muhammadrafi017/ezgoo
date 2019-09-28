<?php

use Faker\Generator as Faker;

$factory->define(App\Models\BankAccount::class, function (Faker $faker) {
  static $num = -1;

  $bank = ["BCA","BRI","Mandiri"];
  $account_name = ["EzGooBCA","EzGooBRI","EzGooMandiri"];
  $account_num = [rand(10000, 99999),rand(10000, 99999),rand(10000, 99999)];
  $num++;

    return [
      'bank' => $bank[$num],
      'account_name' => $account_name[$num],
      'account_number' => $account_num[$num]
    ];
});
