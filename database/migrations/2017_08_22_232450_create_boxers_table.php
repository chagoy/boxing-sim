<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('division');
            $table->unsignedInteger('win');
            $table->unsignedInteger('loss');
            $table->unsignedInteger('knockouts');
            $table->unsignedInteger('draws');
            $table->unsignedInteger('power');
            $table->unsignedInteger('speed');
            $table->unsignedInteger('chin');
            $table->unsignedInteger('stamina');
            $table->unsignedInteger('offense');
            $table->unsignedInteger('defense');
            $table->unsignedInteger('popularity');
            $table->unsignedInteger('health');
            $table->unsignedInteger('potential');
            $table->unsignedInteger('contract');
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('promoter_id');
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
        Schema::dropIfExists('boxers');
    }
}
