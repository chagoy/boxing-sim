<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxerFightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxer_fight', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('boxer_id')->unsigned();
            $table->integer('fight_id')->unsigned();

            $table->foreign('boxer_id')->references('id')->on('boxers')->onDelete('cascade');
            $table->foreign('fight_id')->references('id')->on('fights')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxer_fight');
    }
}
