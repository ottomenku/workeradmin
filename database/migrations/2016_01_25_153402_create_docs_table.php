<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function(Blueprint $table) {
            $table->increments('id'); 
            $table->integer('ceg_id')->unsigned();
            $table->foreign('ceg_id')->references('id')->on('cegs'); // nem igazán kell csak könnyít
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');   
            $table->string('origin')->nullable();
            $table->string('cat')->nullable();
            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('path')->nullable();;
            $table->text('editordata');//text nem lehet null
            $table->text('data')->nullable(); // json kell majd
            $table->string('worknote')->nullable();
            $table->string('adnote')->nullable();
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
        Schema::drop('docs');
    }
}
