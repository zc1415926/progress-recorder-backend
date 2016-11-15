<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance', function(Blueprint $table){
            $table->increments('id');
            $table->tinyInteger('delta_score');
            $table->string('comment');
            $table->string('student_number');
            $table->timestamps();
            
            $table->foreign('student_number')
                  ->references('student_number')
                  ->on('students')
                  ->onDelete('cascade');
            $table->index('student_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('performance');
    }
}