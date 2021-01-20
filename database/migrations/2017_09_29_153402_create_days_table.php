<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->integer('daytype_id')->unsigned();
            $table->foreign('daytype_id')->references('id')->on('daytypes');       
            $table->date('datum');
            $table->string('adnote')->nullable();
            $table->string('worknote')->nullable();
            $table->smallInteger('pub')->default(0);
         $table->timestamps();
         $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('days');
    }
}
