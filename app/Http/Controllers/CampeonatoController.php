<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\TotalPontos;
use App\Models\PosicaoDinamica;
use Exception;

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

    public function index(Request $request, $idTemporada)
    {
        $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
        $posicaoGeral = $this->posicaoDinamica->getPosicaoRodada($idTemporada, ($maxPartida + 1));

        return view('campeonatos.index')
            ->with('posicaoGeral', $posicaoGeral)
            ->with('idTemporada', $idTemporada);
    }

    public function getPosicoesDinamicas(Request $request)
    {
        try {
            $idTemporada = $request->get('idTemporada');
            $maxPartida = $this->totalPontos->getMaxPartida($idTemporada);
            $posicoes = $this->posicaoDinamica->getPosicaoRodada($idTemporada, ($maxPartida + 1));
            $countPosicoes = count($posicoes);

            $grafico = array();
            $times = array();
            foreach ($posicoes as $posicao) {
                $times[] = ['id' => $posicao->idTime, 'nome' => $posicao->nomeTime];
            }

            $grafico[] = $times;
            $linhas = array();
            for ($i = 2; $i <= ($maxPartida + 1); $i++) {
                $nomesTimes = array();
                $posicaoDin = $this->posicaoDinamica->getPosicaoRodada($idTemporada, $i);
                foreach ($posicaoDin as $posicaoD) {
                    $nomesTimes[] = $posicaoD->nomeTime;
                }
                
                $linha = [($i-1)];
                foreach ($times as $time) {
                    $linha[] = -((array_search($time['nome'], $nomesTimes)) + 1);
                }
                $linhas[] = $linha;
            }

            $grafico[] = $linhas;
            $grafico[] = ($countPosicoes * 2) - 2;

            return response()->json($grafico);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(null);
        }
    }
}