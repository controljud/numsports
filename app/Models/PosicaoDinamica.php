<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PosicaoDinamica extends Model
{
    protected $table = 'posicoes';
    public $timestamps = false;

    public function getPosicaoRodada($idTemporada, $numPartida)
    {
        $sql = "select
                    tp.idTime,
                    @contador := @contador + 1 AS posicao,
                    t.nome as nomeTime,
                    t.cor as corTime,
                    tp.pontos,
                    tp.numPartida,
                    tp.vitorias,
                    tp.empates,
                    tp.derrotas,
                    tp.golsFeitos,
                    tp.golsSofridos,
                    tp.saldo
                from
                    (SELECT @contador := 0) AS tabela_auxiliar,
                    total_pontos tp
                    join times t on t.id = tp.idTime
                where
                    tp.numPartida = (select max(numPartida) from total_pontos where idTime = tp.idTime and idTemporada = tp.idTemporada and numPartida < $numPartida)
                    and tp.idTemporada = $idTemporada
                order by
                    tp.pontos desc,
                    tp.vitorias desc,
                    tp.saldo desc,
                    tp.golsFeitos desc";
        
        return DB::select(DB::raw($sql));
    }

    public function getPartidasTotais($idTemporada)
    {
        $sql = "select ((count(distinct idMandante) * 2) - 2) as maximo from partidas where idTemporada = 1";

        return DB::select(DB::raw($sql));
    }
}
