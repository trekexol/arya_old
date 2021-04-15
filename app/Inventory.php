<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function products(){
        return $this->belongsTo('App\Permission\Models\Product','product_id');
    }
}
