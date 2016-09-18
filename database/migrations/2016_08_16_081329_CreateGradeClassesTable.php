<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradeClasses', function (Blueprint $table) {
            $table->string('classCode')->unique()->primary();
            $table->string('entryYear');
            $table->string('gradeNum');
            $table->string('classNum');
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
        Schema::drop('gradeClasses');
    }
}
