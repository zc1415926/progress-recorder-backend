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
            $table->string('term_code');
            $table->timestamps();
            
            $table->index('student_number');
            $table->index('term_code');
            /*
            外键会带来很多约束问题，先不用了
            
            $table->foreign('student_number')
                  ->references('student_number')
                  ->on('students')
                  ->onDelete('cascade');
                  
            
            $table->foreign('term_code')
                  ->references('term_code')
                  ->on('term')
                  ->onDelete('cascade');*/
            
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