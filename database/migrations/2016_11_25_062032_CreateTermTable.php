<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function(Blueprint $table){
            $table->increments('id');
            //term_code = year . season
            $table->string('term_code', 5);
            $table->string('year', 4);
            //值为"0"代表春季学期，值为"1"时代表秋季学期
            $table->string('season', 1);
            $table->timestamps();
            
            $table->index('term_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('terms');
    }
}
