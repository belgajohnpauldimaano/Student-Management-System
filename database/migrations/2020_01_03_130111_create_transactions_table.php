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
            $table->double('balance');
            $table->string('email');
            $table->string('number');
            $table->string('receipt_img')->nullable();
            $table->string('payment_option')->nullable();
            $table->enum('approval', array('Approved', 'Not yet approved'))->default('Not yet approved');
            $table->tinyInteger('isSuccess')->nullable();
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
