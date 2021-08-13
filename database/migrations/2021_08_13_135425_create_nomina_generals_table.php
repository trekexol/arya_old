<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('unit_tributary',64,2);
            $table->decimal('day_utility',64,2);
            $table->decimal('day_bonus_vacation',64,2);
            $table->decimal('day_vacation',64,2);
            $table->decimal('sso',64,2);
            $table->decimal('faov',64,2);
            $table->decimal('pie',64,2);
            $table->decimal('sso_company',64,2);
            $table->decimal('faov_company',64,2);
            $table->decimal('pie_company',64,2);
            $table->decimal('rate_benefit',64,2);
            $table->decimal('day_cenefit',64,2);
            $table->decimal('cestaticket',64,2);
            $table->decimal('amount_cestaticket',64,2);
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
        Schema::dropIfExists('nomina_generals');
    }
}
