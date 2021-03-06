<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_number')->unique();
            $table->string('student_name');
            $table->string('classCode');
            $table->timestamps();
            
            /*
            外键会带来很多约束问题，先不用了
            $table->foreign('classCode')
                  ->references('classCode')
                  ->on('gradeClasses')
                  ->onDelete('cascade');
                  */
                  
            $table->index('classCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
