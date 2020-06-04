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
            $table->increments('id');
            $table->string('or_no')->nullable();
            $table->integer('student_id');
            $table->string('discount_type');
            $table->float('discount_amt');
            $table->integer('transaction_month_paid_id');
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
