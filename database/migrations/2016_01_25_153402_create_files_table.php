<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table) {
            $table->increments('id');      
            $table->string('origin');
            $table->string('name');
            $table->string('filename');
            $table->string('path');
            $table->string('worknote')->nullable();
            $table->string('adnote')->nullable();

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
        Schema::drop('files');
    }
}
