<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    public function products(){
        return $this->belongsTo('App\Permission\Models\Product','id_product');
    }
}
