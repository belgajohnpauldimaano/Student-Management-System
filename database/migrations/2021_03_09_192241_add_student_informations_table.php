<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_informations', function (Blueprint $table) {
            $table->string('religion')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('fb_acct')->nullable();
            $table->text('place_of_birth')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_fb_acct')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_fb_acct')->nullable();
            $table->string('guardian_fb_acct')->nullable();
            $table->integer('no_siblings')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_informations', function (Blueprint $table) {
            $table->dropColumn('religion');
            $table->dropColumn('citizenship');
            $table->dropColumn('fb_acct');
            $table->dropColumn('place_of_birth');
            $table->dropColumn('father_occupation');
            $table->dropColumn('father_fb_acct');
            $table->dropColumn('mother_occupation');
            $table->dropColumn('mother_fb_acct');
            $table->dropColumn('guardian_fb_acct');
            $table->dropColumn('no_siblings');
        });
    }
}