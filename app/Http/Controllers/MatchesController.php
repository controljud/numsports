<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UpdateServiceFutebol;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\TotalPontos;
use App\Models\Posicao;
use DB;

class MatchesController extends Controller
{
    private $updateService;
    private $campeonato;
    private $time;
    private $partida;
    private $totalPontos;
    private $posicao;

    public function __construct()
    {
        $this->updateService = new UpdateServiceFutebol;

        $this->campeonato = new Campeonato;
        $this->time = new Time;
        $this->partida = new Partida;
        $this->totalPontos = new TotalPontos;
        $this->posicao = new Posicao;
    }

    public function index()
    {
        return view('admin.partidas');
    }

    public function getDataFutebolBrasileiro(Request $request, $idTemporada)
    {
        set_time_limit(0);
        $campeonato = $this->campeonato->getCampeonato($idTemporada);
        $eventos = $this->updateService->getDataFutebolBrasileiroMasculino($campeonato);

        foreach ($eventos as $evento) {
            $mandante = $this->time->getTime($evento['mandante']);
            $visitante = $this->time->getTime($evento['visitante']);
            
            $this->partida->setPartida($evento['data'], $mandante->id, $visitante->id, $evento['placar'][0], $evento['placar'][1], $campeonato->id);
        }

        $this->totalizarDados($campeonato->id);
        //$this->setPosicoesDinamicas($campeonato->id);
        
        return response()->json(['message' => 'Dados atualizados com sucesso - ' . $campeonato->nome . ': ' . $campeonato->temporada]);
    }

    private function totalizarDados($idTemporada)
    {   
        $times = $this->time->getTimesCampeonato($idTemporada);

        $dados = array();
        $partidas = Partida::where('idTemporada', $idTemporada)->get();

        foreach ($times as $time) {
            $pontos = 0;
            $numPartida = 0;
            $vitorias = 0;
            $empates = 0;
            $derrotas = 0;
            $golsFeitos = 0;
            $golsSofridos = 0;

            foreach ($partidas as $partida) {
                if ($partida->idMandante == $time->id || $partida->idVisitante == $time->id) {
                    $numPartida++;

                    if ($partida->idMandante == $time->id) {
                        $golsFeitos += $partida->placarMandante;
                        $golsSofridos += $partida->placarVisitante;

                        if ($partida->placarMandante > $partida->placarVisitante) {
                            $vitorias++;
                            $pontos += 3;
                        } else if ($partida->placarMandante < $partida->placarVisitante) {
                            $derrotas++;
                        } else if ($partida->placarMandante == $partida->placarVisitante) {
                            $empates++;
                            $pontos++;
                        }
                    } else if ($partida->idVisitante == $time->id) {
                        $golsFeitos += $partida->placarVisitante;
                        $golsSofridos += $partida->placarMandante;

                        if ($partida->placarMandante > $partida->placarVisitante) {
                            $derrotas++;
                        } else if ($partida->placarMandante < $partida->placarVisitante) {
                            $vitorias++;
                            $pontos += 3;
                        } else if ($partida->placarMandante == $partida->placarVisitante) {
                            $empates++;
                            $pontos++;
                        }
                    }

                    $total = $this->totalPontos->getTotalizado($time->id, $idTemporada, $numPartida);
                    
                    if (!$total) {
                        $total = new TotalPontos;
                        $total->idTime = $time->id;
                        $total->idTemporada = $idTemporada;
                        $total->pontos = $pontos;
                        $total->numPartida = $numPartida;
                        $total->vitorias = $vitorias;
                        $total->empates = $empates;
                        $total->derrotas = $derrotas;
                        $total->golsFeitos = $golsFeitos;
                        $total->golsSofridos = $golsSofridos;
                        $total->saldo = $golsFeitos - $golsSofridos;
                        $total->save();
                    }
                }
            }
        }

        return true;
    }

    public function setPosicoesDinamicas($idTemporada)
    {
        $this->posicao->delete();

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

        $posicao = new Posicao;
        $posicao->idTemporada = $idTemporada;
        $posicao->idTime = $idTime;
        $posicao->nomeTime = $nomeTime;
        $posicao->save();
    }
}