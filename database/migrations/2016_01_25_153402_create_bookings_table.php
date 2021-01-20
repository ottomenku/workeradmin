<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->integer('daytype_id')->unsigned();
            $table->foreign('daytype_id')->references('id')->on('daytypes');       
            $table->date('start');
            $table->date('end')->nullable();
            $table->string('adnote')->nullable();
            $table->string('worknote')->nullable();
            $table->smallInteger('pub')->default(0);
            $table->smallInteger('open')->default(1);
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
        Schema::drop('bookings');
    }
}
