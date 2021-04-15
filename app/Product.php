<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function segments(){
        return $this->belongsTo('App\Permission\Models\segment','segment_id');
    }

    public function subsegments(){
        return $this->belongsTo('App\Permission\Models\SubSegment','subsegment_id');
    }

    public function unitofmeasures(){
        return $this->belongsTo('App\Permission\Models\UnitOfMeasure','unit_of_measure_id');
    }

}
