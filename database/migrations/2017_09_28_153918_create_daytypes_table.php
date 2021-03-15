<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaytypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daytypes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('ceg_id')->unsigned()->default(1);
            $table->foreign('ceg_id')->references('id')->on('cegs');
            $table->integer('timetype_id')->unsigned()->nullable();
            $table->foreign('timetype_id')->references('id')->on('timetypes');
            $table->string('name');
            $table->boolean('workday'); 
            $table->decimal('szorzo',4,2)->default(1)->nullable();
            $table->integer('fixplusz')->default(0)->nullable();
            $table->string('color')->default('grey');
            $table->string('icon')->default('circle');
            $table->string('background')->default('none');
            $table->string('basehour')->nullable();
            $table->string('basestart')->nullable();
            $table->string('baseend')->nullable();
            $table->string('note')->nullable();
            $table->boolean('userallowed')->default(0);
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
        Schema::drop('daytypes');
    }
}
