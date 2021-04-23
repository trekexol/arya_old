<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
           /* $table->unsignedInteger('account_code_one');
            $table->unsignedInteger('account_code_two');
            $table->unsignedInteger('account_code_three');
            $table->unsignedInteger('account_code_four');
            $table->unsignedInteger('account_period');

            $table->unsignedInteger('counterpart_code_one');
            $table->unsignedInteger('counterpart_code_two');
            $table->unsignedInteger('counterpart_code_three');
            $table->unsignedInteger('counterpart_code_four');
            $table->unsignedInteger('counterpart_period');
          
            $table->unsignedInteger('id_header');

            $table->unsignedInteger('id_client')->nullable();
            $table->unsignedInteger('id_vendor')->nullable();

            $table->string('type_movement',2);

            $table->date('date');

            $table->string('reference',30);


            $table->string('status',1);
            
           /* $table->foreign(['code_one','code_two','code_three','code_four','period'])
            ->references(['code_one','code_two','code_three','code_four','period'])->on('accounts');

            $table->foreign('id_header')->references('id')->on('header_vouchers');*/
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
        Schema::dropIfExists('bank_movements');
    }
}
