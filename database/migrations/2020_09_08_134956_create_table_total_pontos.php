<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTotalPontos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_pontos', function (Blueprint $table) {
            $table->unsignedBigInteger('idTemporada');
            $table->unsignedBigInteger('idTime');
            $table->integer('numPartida');
            $table->integer('pontos');
            $table->integer('vitorias');
            $table->integer('empates');
            $table->integer('derrotas');
            $table->integer('golsFeitos');
            $table->integer('golsSofridos');
            $table->integer('saldo');

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
        Schema::dropIfExists('total_pontos');
    }
}
