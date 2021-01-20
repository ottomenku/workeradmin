<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ceg_id')->unsigned();
            $table->foreign('ceg_id')->references('id')->on('cegs'); // nem igazán kell csak könnyít
            if (\App::VERSION() >= '5.8') {
                $table->bigInteger('user_id')->unsigned();
            } else {
                $table->integer('user_id')->unsigned();
            }
            $table->foreign('user_id')->references('id')->on('users'); //admin 
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->date('datum');
            $table->string('name');
            $table->string('note')->nullable();
            $table->json('fulldata')->nullable();
            $table->json('solverdata')->nullable();// nem igazán kell csak könnyít
            $table->boolean('lezarva')->default(false);//számfejthető
            $table->boolean('pub')->default(false); //a dolgozó is láthatja
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
        Schema::dropIfExists('jsons');
    }
}
