<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePartidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->unsignedBigInteger('idTemporada');
            $table->unsignedBigInteger('idMandante');
            $table->unsignedBigInteger('idVisitante');
            $table->integer('placarMandante')->nullable();
            $table->integer('placarVisitante')->nullable();
            $table->timestamp('data');

            $table->foreign('idTemporada')->references('id')->on('temporadas');
            $table->foreign('idMandante')->references('id')->on('times');
            $table->foreign('idVisitante')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
