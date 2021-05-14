<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_account');
            $table->unsignedBigInteger('id_header_voucher');
            $table->unsignedBigInteger('id_invoice')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->decimal('debe',16,2);
            $table->decimal('haber',16,2);

            $table->string('status',1);
            $table->foreign('id_account')->references('id')->on('accounts');
            $table->foreign('id_header_voucher')->references('id')->on('header_vouchers');
            $table->foreign('id_invoice')->references('id')->on('quotations');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('detail_vouchers');

    }
}
