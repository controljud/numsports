<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model{
    protected $table = 'campeonatos';
    public $timestamps = false;

    public function getCampeonato($idCampeonato)
    {
        return $this::join('temporadas', 'temporadas.idCampeonato', 'campeonatos.id')
            ->where('temporadas.id', $idCampeonato)
            ->first();
    }
}