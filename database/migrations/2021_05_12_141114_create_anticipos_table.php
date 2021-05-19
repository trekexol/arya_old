<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnticiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_account');
            $table->unsignedBigInteger('id_user');

            $table->date('date');
            $table->decimal('amount',16,2);
            $table->string('reference',20)->nullable();
            
           
            $table->string('status',1);
            
            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_account')->references('id')->on('accounts');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('anticipos');
    }
}
