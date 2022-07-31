<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getPartidas($idTemporada)
    {
        $sql = "select
                    p.data,
                    t1.nome as mandante,
                    p.placarMandante,
                    p.placarVisitante,
                    t2.nome as visitante
                from
                    partidas p
                    join times t1 on t1.id = p.idMandante
                    join times t2 on t2.id = p.idVisitante
                where
                    p.idTemporada = $idTemporada
                order by
                    p.data asc";

        return DB::select(DB::raw($sql));
    }
}