<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    public function clients(){
        return $this->belongsTo('App\Permission\Models\Client','id_client');
    }
    public function vendors(){
        return $this->belongsTo('App\Permission\Models\Vendor','id_vendor');
    }
    public function transports(){
        return $this->belongsTo('App\Permission\Models\Transport','id_transport');
    }

    public function quotation_product() {
        return $this->hasMany('App\QuotationProduct');   
    }
}
