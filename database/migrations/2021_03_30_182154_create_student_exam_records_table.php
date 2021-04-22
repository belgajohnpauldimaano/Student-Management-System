<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exam_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_information_id');
            $table->bigInteger('assessment_id');
            $table->bigInteger('question_id');
            $table->integer('student_answer_option')->nullable();
            $table->tinyInteger('student_answer_option_status')->default(0);
            $table->tinyInteger('remarks');
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
        Schema::dropIfExists('student_exam_records');
    }
}