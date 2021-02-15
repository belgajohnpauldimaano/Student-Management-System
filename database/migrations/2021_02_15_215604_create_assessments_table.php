<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_subject_details_id');
            $table->string('title');
            $table->dateTime('date_time_publish');
            $table->dateTime('date_time_expiration');
            $table->integer('total')->nullable();
            $table->tinyInteger('semester');
            $table->tinyInteger('quarter');
            $table->tinyInteger('exam_type');
            $table->tinyInteger('time_limit')->default(1)->comment('1-yes 0-no');
            $table->Integer('assessment_time');
            $table->tinyInteger('randomly_ordered')->default(0)->comment('1-yes 0-no');
            $table->tinyInteger('student_view_result')->default(0)->comment('0-No and 1-yes');
            $table->Integer('student_no_attempts');
            $table->tinyInteger('exam_status')->default(0)->comment('default draft by 0, 1-published, 2-archived');
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
        Schema::dropIfExists('assessments');
    }
}