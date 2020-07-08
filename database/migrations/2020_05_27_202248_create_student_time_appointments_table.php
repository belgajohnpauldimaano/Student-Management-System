<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTimeAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_time_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_year_id');
            $table->bigInteger('online_appointment_id');
            $table->bigInteger('student_id');
            $table->bigInteger('grade_lvl');
            $table->bigInteger('queueing_number');
            $table->string('email');
            $table->tinyInteger('approval')->nullable();
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
        Schema::dropIfExists('student_time_appointments');
    }
}
