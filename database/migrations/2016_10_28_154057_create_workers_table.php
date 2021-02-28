<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function(Blueprint $table) {
            $table->increments('id');
            if (\App::VERSION() >= '5.8') {
                $table->bigInteger('user_id')->unsigned()->onDelete("cascade");
            } else {
                $table->integer('user_id')->unsigned()->onDelete("cascade");
            }  
            $table->integer('ceg_id')->unsigned();
            $table->foreign('ceg_id')->references('id')->on('cegs')->onDelete("cascade");;
        //    $table->integer('group_id')->unsigned();
       //     $table->foreign('group_id')->references('id')->on('groups');
 
      //      $table->integer('status_id')->unsigned();
     //       $table->foreign('status_id')->references('id')->on('statuses');
     //       $table->integer('workertype_id')->unsigned();
     //       $table->foreign('workertype_id')->references('id')->on('workertypes');
     //      $table->integer('salary');
      //      $table->string('salary_type');
            $table->string('position')->nullable();
            $table->string('foto')->nullable();
            $table->string('fullname')->nullable();
            $table->string('workername')->nullable();
            $table->string('mothername')->nullable();
            $table->string('city')->nullable();
            $table->string('cim')->nullable();
            $table->string('tel')->nullable();
            $table->date('birth')->nullable();
            $table->date('birthplace')->nullable();
            $table->string('alapber')->nullable();
             $table->string('bertipus')->nullable();
            $table->string('ado')->nullable();
            $table->string('tb')->nullable();
            $table->string('szig')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('note')->nullable();
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
        Schema::drop('workers');
    }
}
