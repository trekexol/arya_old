<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anticipo extends Model
{
    public function clients(){
        return $this->belongsTo('App\Permission\Models\Client','id_client');
    }

    public function accounts(){
        return $this->belongsTo('App\Permission\Models\Account','id_account');
    }
}
