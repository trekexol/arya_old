<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesAndPurchase extends Model
{
    public function providers(){
        return $this->belongsTo('App\Permission\Models\Provider','id_provider');
    }

    public function expensedetails() {
        return $this->hasMany('App\ExpenseDetail');   
    }
}
