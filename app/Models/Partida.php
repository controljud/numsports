<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Partida extends Model{
    protected $table = 'partidas';
    public $timestamps = false;

    public function setPartida($data, $idMandante, $idVisitante, $placarMandante, $placarVisitante, $idTemporada)
    {
        $partida = $this::where('idMandante', $idMandante)
            ->where('idVisitante', $idVisitante)
            ->where('idTemporada', $idTemporada)
            ->first();
        
        if (!$partida) {
            $partida = new Partida;
            $partida->idTemporada = $idTemporada;
            $partida->idMandante = $idMandante;
            $partida->idVisitante = $idVisitante;
            $partida->placarMandante = $placarMandante;
            $partida->placarVisitante = $placarVisitante;
            $partida->data = $data;
            $partida->save();
        }
    }

    public function getUltimosResultados($idTemporada, $idTime)
    {
        $sql = "select
                    x.resultado
                from
                    (select
                        data,
                        case
                            when placarMandante > placarVisitante then 3
                            when placarMandante = placarVisitante then 1
                            when placarMandante < placarVisitante then 0
                        end as resultado
                    from
                        partidas
                    where
                        idMandante = $idTime
                        and idTemporada = $idTemporada
                    union
                    select
                        data,
                        case
                            when placarVisitante > placarMandante then 3
                            when placarVisitante = placarMandante then 1
                            when placarVisitante < placarMandante then 0
                        end as resultado
                    from
                        partidas
                    where
                        idVisitante = $idTime
                        and idTemporada = $idTemporada) x
                order by
                    x.data desc
                limit 5";
        
        return DB::select(DB::raw($sql));
    }
}