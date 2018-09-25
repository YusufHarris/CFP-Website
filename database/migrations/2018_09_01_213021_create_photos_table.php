<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('photos', function (Blueprint $table){
        $table->increments('id');
        $table->timestamps();
        $table->string('filename');
        $table->string('filename2');
        $table->string('description')->default('No description.');
        $table->integer('gallery_id')->default()->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
