<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Station;

class UserStation extends Model
{
    protected $table = 'user_stations';

    public function station_info() {
        return $this->hasOne(Station::class, 'id', 'station_id');
    }
}
