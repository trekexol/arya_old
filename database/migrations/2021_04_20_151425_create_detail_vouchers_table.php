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
            $table->unsignedInteger('code_one');
            $table->unsignedInteger('code_two');
            $table->unsignedInteger('code_three');
            $table->unsignedInteger('code_four');
            $table->unsignedInteger('period');
          
            $table->unsignedInteger('id_header_voucher');

            $table->decimal('debe',16,2);
            $table->decimal('haber',16,2);

            $table->integer('ref');



            $table->string('status',1);
            
           /* $table->foreign(['code_one','code_two','code_three','code_four','period'])
            ->references(['code_one','code_two','code_three','code_four','period'])->on('accounts');*/

            $table->foreign('id_header_voucher')->references('id')->on('header_vouchers');
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
