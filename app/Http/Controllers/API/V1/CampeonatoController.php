<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Campeonato;
use App\Models\Temporada;
use App\Models\Time;
use App\Models\TotalPontos;
use App\Models\PosicaoDinamica;
use Exception;

class CampeonatoController extends Controller
{
    private $campeonato;
    private $temporada;
    private $time;
    private $partida;
    private $totalPontos;
    private $posicaoDinamica;

    public function __construct()
    {
        $this->campeonato = new Campeonato;
        $this->temporada = new Temporada;
        $this->time = new Time;
        $this->partida = new Partida;
        $this->totalPontos = new TotalPontos;
        $this->posicaoDinamica = new PosicaoDinamica;
    }

    public function getPosicaoGeral(Request $request, $idTemporada)
    {
        try {
            $campeonato = $this->campeonato->getCampeonato($idTemporada);
            $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
            $posicaoGeral = $this->posicaoDinamica->getPosicaoRodada($idTemporada, ($maxPartida + 1));

            foreach ($posicaoGeral as $posicao) {
                $resultados = $this->partida->getUltimosResultados($idTemporada, $posicao->idTime);
                $posicao->resultados = $resultados;
            }

            return response()->json(['campeonato' => $campeonato, 'max_partida' => $maxPartida, 'posicao_geral' => $posicaoGeral]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $ex;
            return response()->json(['campeonato' => null, 'max_partida' => null, 'posicao_geral' => null]);
        }
    }

    public function getPosicaoDinamica(Request $request, $idTemporada)
    {
        try {
            $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
            $totaisPartida = $this->posicaoDinamica->getPartidasTotais($idTemporada);
            $posicaoAtual = $this->posicaoDinamica->getPosicaoRodada($idTemporada, $maxPartida);

            $labels = [];
            $times = [];
            $dataset = [];
            
            for ($i = 1; $i <= ($maxPartida + 1); $i++) {
                $posicaoDin = $this->posicaoDinamica->getPosicaoRodada($idTemporada, $i);

                $x = 1;
                foreach ($posicaoDin as $posicao) {
                    if (isset ($times[$posicao->nomeTime])) {
                        $data = $times[$posicao->nomeTime]['data'];
                        $times[$posicao->nomeTime]['data'][] = $x;
                        $times[$posicao->nomeTime]['posicao'] = $x;
                    } else {
                        $times[$posicao->nomeTime] = [
                            'label' => $posicao->nomeTime,
                            'data' => [$x],
                            'backgroundColor' => "transparent",
                            'borderColor' => $posicao->corTime ? $posicao->corTime : "#cdcdcd",
                            'pointBackgroundColor' => $posicao->corTime ? $posicao->corTime : "#cdcdcd",
                            'posicao' => $x
                        ];
                    }
                    $x++;
                }
            }
            
            foreach ($times as $time) {
                $dataset[] = $time;
            }

            usort($dataset, function($a, $b)
            {
                return ($a['posicao'] < $b['posicao']) ? -1 : 1;
            });

            for ($i = 1; $i <= $totaisPartida[0]->maximo; $i++) {
                $labels[] = $i;
            }

            return response()->json(['dataset' => $dataset, 'labels' => $labels]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['dataset' => null, 'labels' => null]);
        }
    }

    public function getCampeonatos()
    {
        $campeonatos = $this->campeonato->getCampeonatos();
        return response()->json($campeonatos);
    }

    public function getTemporadas(Request $request, $idCampeonato = 1)
    {   
        $temporadas = $this->temporada->getTemporadas(1);
        return response()->json($temporadas);
    }
}