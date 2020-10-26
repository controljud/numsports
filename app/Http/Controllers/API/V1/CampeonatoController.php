<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\TotalPontos;
use App\Models\PosicaoDinamica;
use DB;

class CampeonatoController extends Controller
{
    private $campeonato;
    private $time;
    private $partida;
    private $totalPontos;
    private $posicaoDinamica;

    public function __construct()
    {
        $this->campeonato = new Campeonato;
        $this->time = new Time;
        $this->partida = new Partida;
        $this->totalPontos = new TotalPontos;
        $this->posicaoDinamica = new PosicaoDinamica;
    }

    public function getPosicaoGeral()
    {
        $idTemporada = 1;
        
        $campeonato = $this->campeonato->getCampeonato($idTemporada);
        $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
        $posicaoGeral = $this->posicaoDinamica->getPosicaoRodada($idTemporada, ($maxPartida + 1));

        foreach ($posicaoGeral as $posicao) {
            $resultados = $this->partida->getUltimosResultados($idTemporada, $posicao->idTime);
            $posicao->resultados = $resultados;
        }

        return response()->json(['campeonato' => $campeonato, 'max_partida' => $maxPartida, 'posicao_geral' => $posicaoGeral]);
    }
}