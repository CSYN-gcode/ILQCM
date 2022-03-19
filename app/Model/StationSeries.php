<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Series;

class StationSeries extends Model
{
    protected $table = 'station_serieses';

    public function series_info() {
        return $this->hasOne(Series::class, 'id', 'series_id');
    }
}
