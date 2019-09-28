<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    public function trainSchedule()
    {
      return $this->hasOne('App\Models\TrainSchedule');
    }
    public function trainFare()
    {
      return $this->hasOne('App\Models\TrainFare');
    }
}
