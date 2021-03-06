<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctemplates', function(Blueprint $table) {
            $table->increments('id'); 
            $table->integer('ceg_id')->unsigned();
            $table->foreign('ceg_id')->references('id')->on('cegs')->default(1); // nem igazán kell csak könnyít
            $table->string('cat')->default('vegyes');
            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->text('editordata')->default('file');//text nem lehet null
            $table->string('note')->nullable();
            $table->smallInteger('pub')->default(1);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('docs');
    }
}
