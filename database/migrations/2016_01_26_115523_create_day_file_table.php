<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_file', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('file_id')->unsigned()->index();
                $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
                $table->integer('day_id')->unsigned()->index();
                $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
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
   
        Schema::dropIfExists('day_file');
    }
}
