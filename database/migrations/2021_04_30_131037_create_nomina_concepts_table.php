<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_concepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abbreviation',15);
            $table->integer('order');
            $table->string('description',60);
            $table->string('type',20);
            $table->string('sign',1);
            $table->string('calculate',1);
            $table->string('formula_m',60)->nullable();
            $table->string('formula_s',60)->nullable();
            $table->string('formula_q',60)->nullable();

            $table->decimal('minimum',64,2)->nullable();
            $table->decimal('maximum',64,2)->nullable();

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
        Schema::dropIfExists('nomina_concepts');
    }
}
