<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_type');
            $table->text('instructions');
            $table->Integer('order_number');
            $table->string('type')->comment('assessment or quiz or assignment');
            $table->morphs('instructionable');
            $table->tinyInteger('status')->default(1)->comment('0 is soft deleted 2 is archived 1 is active');
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
        Schema::dropIfExists('instructions');
    }
}