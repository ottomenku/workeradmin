<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cegs', function (Blueprint $table) {
            $table->increments('id');   
            if (\App::VERSION() >= '5.8') {
                $table->bigInteger('user_id')->unsigned();
            } else {
                $table->integer('user_id')->unsigned();
            }
            $table->string('ugyvezeto')->nullable();
            $table->string('szekhely')->nullable();
            $table->string('cim')->nullable();
            $table->string('ado')->nullable();
            $table->string('cegnev'); // a name nemjó mert nem feleslegesen koplikálja az admin name felvitelét...
            $table->string('note')->nullable();
            $table->smallInteger('docedit')->default(1);
            $table->smallInteger('timeedit')->default(1);
            $table->smallInteger('timeform')->default(1);
            $table->smallInteger('pub')->default(1);
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
        Schema::drop('cegs');
    }
}
