<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Time extends Model{
    protected $table = 'times';
    public $timestamps = false;

    public function getTime($nome)
    {
        $time = $this::where('nome', $nome)->first();
        if (!$time) {
            $time = new Time;
            $time->nome = $nome;
            $time->save();
        }

        return $time;
    }

    private function getIdsMandantes($idTemporada)
    {
        return DB::table('partidas')
            ->select('idMandante')
            ->join('temporadas', 'temporadas.id', 'partidas.idTemporada')
            ->where('temporadas.id', $idTemporada)
            ->distinct()
            ->pluck('idMandante');
    }

    private function getIdsVisitantes($idTemporada)
    {
        return DB::table('partidas')
            ->select('idVisitante')
            ->join('temporadas', 'temporadas.id', 'partidas.idTemporada')
            ->where('temporadas.id', $idTemporada)
            ->distinct()
            ->pluck('idVisitante');
    }

    public function getTimesCampeonato($idTemporada)
    {
        $idsMandantes = $this->getIdsMandantes($idTemporada);
        $idsVisitantes = $this->getIdsVisitantes($idTemporada);

        return DB::table('times')
            ->where(function($query) use($idsMandantes, $idsVisitantes){
                $query->whereIn('id', $idsMandantes)
                    ->orWhereIn('id', $idsVisitantes);
            })->get();
    }
}