<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_vendor');
            $table->unsignedBigInteger('id_transport');
            $table->unsignedBigInteger('id_user');

            $table->string('serie',30)->nullable();
            
            $table->date('date_quotation');
            
            $table->date('date_billing')->nullable();

            $table->date('date_delivery_note')->nullable();

            $table->decimal('anticipo',16,2)->nullable();

          
            $table->integer('iva_percentage')->nullable();

            $table->string('observation',150)->nullable();
            $table->string('note',150)->nullable();

            $table->string('coin',15)->nullable();
           
            $table->string('status',1);
           
            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_vendor')->references('id')->on('vendors');
            $table->foreign('id_transport')->references('id')->on('transports');
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
        Schema::dropIfExists('quotations');
    }
}
