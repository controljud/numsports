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
}