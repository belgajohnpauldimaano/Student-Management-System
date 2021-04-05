<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exam_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_start');
            $table->bigInteger('assessment_id');
            $table->bigInteger('student_information_id');
            $table->bigInteger('assessment_outcome')->comment('1 pass 0 is fail');
            $table->tinyInteger('status')->comment('1-student started exam, 2-not started, 3 done');
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
        Schema::dropIfExists('student_exam_details');
    }
}