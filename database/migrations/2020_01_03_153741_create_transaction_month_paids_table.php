<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionMonthPaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_month_paids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('or_no');
            $table->bigInteger('transaction_id');
            $table->integer('student_id');
            $table->double('payment');
            $table->integer('school_year_id');
            $table->float('balance')->nullable()->default(10.2);
            $table->string('email', 191);
            $table->string('number', 191);
            $table->string('receipt_img', 191)->nullable();
            $table->string('payment_option', 191);
            $table->string('approval', 191);
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
        Schema::dropIfExists('transaction_month_paids');
    }
}
