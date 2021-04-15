<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
  
    public function up()
    {
        
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_client',20);
            $table->string('razon_social',80);
            $table->string('name',80);
            $table->string('cedula_rif',20);
            $table->string('direction',100);
            $table->string('city',20);
            $table->string('country',20);
            $table->string('phone1',20);
            $table->string('phone2',20);
            $table->boolean('has_credit');
            $table->integer('days_credit');
            $table->double('amount_max_credit', 12, 2);
            $table->double('balance', 16, 2);
            $table->double('retencion_iva', 6, 2);
            $table->double('retencion_islr', 6, 2);
            $table->integer('select_balance');
            $table->string('seller',25);
            $table->string('status',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
