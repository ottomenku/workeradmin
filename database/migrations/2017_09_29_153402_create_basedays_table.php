<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasedaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basedays', function(Blueprint $table) {
            $table->increments('id');
       //     $table->integer('ceg_id')->default(1)->unsigned();
       //     $table->foreign('ceg_id')->references('id')->on('cegs');
       //     $table->integer('daytype_id')->unsigned();
       //     $table->foreign('daytype_id')->references('id')->on('daytypes');
        $table->smallInteger('workday')->default(0); 
        $table->string('name')->nullable();
            $table->date('datum');
           //  $table->boolean('workday'); //nem kell mert a daytypesban van
            $table->string('note')->nullable();
            $table->smallInteger('pub')->default(1);
         $table->timestamps();
   //      $table->softDeletes();
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
