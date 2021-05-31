<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class BankVoucher extends Model
{
    //es: desde aqui
    //en: from here

    protected $fillable = [
        'id', 'description', 'date',
    ];

    public function detailvouchers(){
        return $this->belongsToMany('App\DetailVoucher')->withTimesTamps();
    }


    public function permissions(){
        return $this->belongsToMany('App\Permission\Models\Permission')->withTimesTamps();
    }
}