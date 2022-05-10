<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convois', function (Blueprint $table) {
            $table->id();
            $table->integer('villeDepart_id')->unsigned();
            $table->integer('villeArrivee_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('horaire_id')->unsigned();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('convois');
    }
}