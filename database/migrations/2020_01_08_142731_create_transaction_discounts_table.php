<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_month_id');
            $table->integer('student_id');
            $table->float('discount_fee');
            $table->integer('school_year_id');
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
        Schema::dropIfExists('transaction_discounts');
    }
}
