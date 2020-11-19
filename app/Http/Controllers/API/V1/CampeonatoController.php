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

    public function getPosicaoDinamica()
    {
        try {
            $idTemporada = 1;
            //$idTemporada = $request->get('idTemporada');
            
            $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
            $totaisPartida = $this->posicaoDinamica->getPartidasTotais($idTemporada);

            $labels = [];
            $times = [];
            $dataset = [];
            
            for ($i = 1; $i <= ($maxPartida + 1); $i++) {
                $posicaoDin = $this->posicaoDinamica->getPosicaoRodada($idTemporada, $i);

                foreach ($posicaoDin as $posicao) {
                    if (isset ($times[$posicao->nomeTime])) {
                        $data = $times[$posicao->nomeTime]['data'];
                        $times[$posicao->nomeTime]['data'][] = $posicao->posicao;
                    } else {
                        $times[$posicao->nomeTime] = [
                            'label' => $posicao->nomeTime,
                            'data' => [$posicao->posicao],
                            'backgroundColor' => "transparent",
                            'borderColor' => "rgba(1, 116, 188, 0.50)",
                            'pointBackgroundColor' => "rgba(171, 71, 188, 1)"
                        ];
                    }
                }   
            }
            
            foreach ($times as $time) {
                $dataset[] = $time;
            }

            for ($i = 1; $i <= $totaisPartida[0]->maximo; $i++) {
                $labels[] = $i;
            }

            return response()->json(['dataset' => $dataset, 'labels' => $labels]);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(null);
        }
    }
}