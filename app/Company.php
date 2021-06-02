<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    public function tipoinv()
    {
        return $this->belongsTo('App\InventaryType', 'tipoinv_id');
    }

    public function tiporate()
    {
        return $this->belongsTo('App\RateType', 'tiporate_id');
    }
}
