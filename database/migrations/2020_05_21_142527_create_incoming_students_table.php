<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('school_year_id');
            $table->integer('grade_level_id');
            $table->integer('student_type');
            $table->string('approval');
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
        Schema::dropIfExists('incoming_students');
    }
}
