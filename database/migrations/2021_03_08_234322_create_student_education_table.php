<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_information_id');
            $table->text('school_name');
            $table->string('school_type')->comment('private or public');
            $table->text('school_address');
            $table->string('last_sy_attended');
            $table->float('gw_average');
            $table->integer('strand');
            $table->tinyInteger('is_transferee')->comment('1 yes 0 is no');
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
        Schema::dropIfExists('student_education');
    }
}