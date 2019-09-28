<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    protected $fillable = ['plane_name','eco_seat','bus_seat','first_seat'];

    public function planeSchedule()
    {
      return $this->hasOne('App\Models\PlaneSchedule');
    }
    public function planeFare()
    {
      return $this->hasOne('App\Models\PlaneFare');
    }
}
