<?php

namespace App\Model;

use App\Model\StationSeries;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'stations';

    public function station_series_details() {
        return $this->hasMany(StationSeries::class, 'station_id', 'id');
    }
}
