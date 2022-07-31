<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTemporadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCampeonato');
            $table->string('temporada');
            $table->string('divisao')->default('1');
            $table->string('sexo');
            $table->string('apelido')->nullable();
            $table->string('imagem')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->default(1);

            $table->foreign('idCampeonato')->references('id')->on('campeonatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporadas');
    }
}
