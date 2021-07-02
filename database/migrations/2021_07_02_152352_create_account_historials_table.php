<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_historials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_account');

            $table->date('date_begin');
            $table->date('date_end');

            $table->integer('period');
            $table->decimal('previous_balance',64,2);
            $table->decimal('debe',64,2);
            $table->decimal('haber',64,2);
            $table->decimal('current_balance',64,2);

            $table->decimal('rate',64,2)->nullable();
            $table->string('coin',10)->nullable();

            $table->string('status',1);

            $table->foreign('id_account')->references('id')->on('accounts');
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
        Schema::dropIfExists('account_historials');
    }
}
