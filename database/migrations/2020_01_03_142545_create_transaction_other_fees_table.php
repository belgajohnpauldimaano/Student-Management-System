<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionOtherFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_other_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('or_no');
            $table->integer('student_id');
            $table->integer('others_fee_id');
            $table->integer('school_year_id');
            $table->integer('item_qty');
            $table->double('item_price');       
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
        Schema::dropIfExists('transaction_other_fees');
    }
}
