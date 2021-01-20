<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_file', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('file_id')->unsigned()->index();
                $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
                $table->integer('booking_id')->unsigned()->index();
                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
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
   
        Schema::dropIfExists('booking_file');
    }
}
