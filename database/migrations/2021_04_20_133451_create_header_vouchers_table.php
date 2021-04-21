<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('reference');
            $table->string('description',150);
            $table->date('date');

            $table->string('setting',15)->nullable();
            $table->string('centro_cos',50)->nullable();
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
        Schema::dropIfExists('header_vouchers');
    }
}
