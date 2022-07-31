<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePosicoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posicoes', function (Blueprint $table) {
            $table->unsignedBigInteger('idTemporada');
            $table->unsignedBigInteger('idTime');
            $table->string('nomeTime');
            $table->integer('posicao');
            

            $table->foreign('idTemporada')->references('id')->on('temporadas');
            $table->foreign('idTime')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posicoes');
    }
}
