<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownpaymentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downpayment_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->double('downpayment_amt', 191);
            $table->integer('grade_level_id');
            $table->tinyInteger('modified')->default('0');
            $table->tinyInteger('current')->default('1');
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('downpayment_fees');
    }
}
