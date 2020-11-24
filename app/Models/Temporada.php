<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table = 'temporadas';
    public $timestamps = false;

    public function getTemporadas($idCampeonato)
    {
        return $this::select('temporadas.id', 'temporadas.temporada', 'temporadas.status')
            ->join('partidas', 'partidas.idTemporada', 'temporadas.id')
            ->where('idCampeonato', $idCampeonato)
            ->distinct()->get();
    }
}
