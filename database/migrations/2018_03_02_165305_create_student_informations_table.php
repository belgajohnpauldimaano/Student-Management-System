<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('address');
            $table->dateTime('birthdate');
            $table->text('c_address')->nullable();
            $table->text('p_address')->nullable();
            $table->string('age_june')->nullable();
            $table->string('age_may')->nullable();
            $table->string('guardian',300)->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('current')->default('1');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('isEsc')->default('0');
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
        Schema::dropIfExists('student_informations');
    }
}