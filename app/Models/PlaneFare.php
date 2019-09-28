<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneFare extends Model
{
    protected $fillable = ['plane_id','eco_seat','bus_seat','first_seat'];

    public function plane()
    {
      return $this->belongsTo('App\Models\Plane');
    }
}
