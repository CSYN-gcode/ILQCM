<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Series;

class UserSeries extends Model
{
    protected $table = 'user_serieses';

    public function series_info() {
        return $this->hasOne(Series::class, 'id', 'series_id');
    }
}
