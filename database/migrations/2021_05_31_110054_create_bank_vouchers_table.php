<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->unsignedBigInteger('id_client')->nullable();
            $table->unsignedBigInteger('id_vendor')->nullable();
            $table->unsignedBigInteger('id_provider')->nullable();
            $table->unsignedBigInteger('id_user');

            $table->string('description',150)->nullable();
            $table->string('type_movement',2);
            $table->date('date');
            $table->string('reference',30)->nullable();

            $table->string('status',1);
            
            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_vendor')->references('id')->on('vendors');
            $table->foreign('id_provider')->references('id')->on('providers');
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
        Schema::dropIfExists('bank_vouchers');
    }
}
