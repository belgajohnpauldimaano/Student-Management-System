<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('or_number')->unique();
            $table->integer('payment_category_id');
            $table->integer('student_id');        
            $table->integer('school_year_id');
            $table->double('downpayment');
            $table->integer('no_month_paid');
            $table->integer('total_no_month');
            $table->double('monthly_fee');
            $table->double('last_fee');
            $table->double('balance');
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
        Schema::dropIfExists('transactions');
    }
}
