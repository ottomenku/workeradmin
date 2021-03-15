<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimetypesTable extends Migration
{
    /**
     * Run the migrations.'','', '',
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetypes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('ceg_id')->default(1)->unsigned();
            $table->foreign('ceg_id')->references('id')->on('cegs');   
            $table->string('name');
            $table->decimal('szorzo',4,2)->default(1)->nullable();
            $table->integer('fixplusz')->default(0)->nullable();
            $table->string('color')->nullable();
            $table->string('background')->nullable();
            $table->integer('basehour')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->string('note')->nullable();
            $table->smallInteger('pub')->default(1);
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timetypes');
    }
}
