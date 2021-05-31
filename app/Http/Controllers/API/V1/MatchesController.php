<?php

namespace App\Http\Controllers\API\V1;

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
        set_time_limit(0);
        $times = $this->time->getTimesCampeonato($idTemporada);
        //$this->totalPontos::where('idTemporada', $idTemporada)->delete();

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
                if (
                    (
                        $partida->idMandante == $time->id 
                        || $partida->idVisitante == $time->id
                    )
                ) {
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

                    $rodada = [
                        'idTime' => $time->id,
                        'idTemporada' => $idTemporada,
                        'pontos' => $pontos,
                        'numPartida' => $numPartida,
                        'vitorias' => $vitorias,
                        'empates' => $empates,
                        'derrotas' => $derrotas,
                        'golsFeitos' => $golsFeitos,
                        'golsSofridos' => $golsSofridos,
                        'saldo' => $golsFeitos - $golsSofridos
                    ];

                    $total = $this->totalPontos->getTotalizado($time->id, $idTemporada, $numPartida);
                    
                    if (!$total) {
                        $this->totalPontos->insert($rodada);
                    } else {
                        $this->totalPontos::where('idTime', $time->id)
                            ->where('idTemporada', $idTemporada)
                            ->where('numPartida', $numPartida)
                            ->update($rodada);
                    }
                }
            }
        }

        return true;
    }

    public function totalizacaoDados(Request $request, $idTemporada)
    {
        $this->totalizarDados($idTemporada);

        return response()->json([
            'status' => 1,
            'message' => 'Partidas totalizadas com sucesso'
        ]);
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

    public function getPartidas(Request $request, $idTemporada)
    {
        $partidas = $this->partida::join(DB::raw('times t1'), 't1.id', 'partidas.idMandante')
            ->join(DB::raw('times t2'), 't2.id', 'partidas.idVisitante')
            ->where('partidas.idTemporada', $idTemporada)
            ->select(
                'partidas.data',
                'idMandante',
                't1.nome as mandante',
                'partidas.placarMandante',
                'partidas.placarVisitante',
                'idVisitante',
                't2.nome as visitante'
            )->orderBy('partidas.data', 'desc')
            ->paginate(10);

        return $partidas;
    }

    public function savePartida(Request $request)
    {
        session()->regenerate();
        return csrf_token();

        $partida = $request->all();

        $partida['idMandante'] = isset($partida['mandante']) && is_array($partida['mandante']) ? $partida['mandante']['id'] : $partida['idMandante'];
        $partida['idVisitante'] = isset($partida['visitante']) && is_array($partida['visitante']) ? $partida['visitante']['id'] : $partida['idVisitante'];
        $partida['placarMandante'] = $partida['placarMandante'] != '' ? $partida['placarMandante'] : null;
        $partida['placarVisitante'] = $partida['placarVisitante'] != '' ? $partida['placarVisitante'] : null;

        unset($partida['mandante']);
        unset($partida['visitante']);

        $partidaDB = $this->partida::where('idTemporada', $partida['idTemporada'])
            ->where('idMandante', $partida['idMandante'])
            ->where('idVisitante', $partida['idVisitante'])
            ->first();

        if (!$partidaDB) {
            $this->partida->insert($partida);
        } else {
            $this->partida::where('idTemporada', $partida['idTemporada'])
                ->where('idMandante', $partida['idMandante'])
                ->where('idVisitante', $partida['idVisitante'])
                ->update($partida);
        }
        
        //$this->totalizarDados($partida['idTemporada']);

        return [
            'status' => 1,
            'message' => 'Partida cadastrada com sucesso',
            'data' => $partida
        ];
    }

    public function deletePartida(Request $request)
    {
        $partida = $request->all();
        
        $partida['idMandante'] = isset($partida['mandante']) && is_array($partida['mandante']) ? $partida['mandante']['id'] : $partida['idMandante'];
        $partida['idVisitante'] = isset($partida['visitante']) && is_array($partida['visitante']) ? $partida['visitante']['id'] : $partida['idVisitante'];

        $this->partida::where('idTemporada', $partida['idTemporada'])
            ->where('idMandante', $partida['idMandante'])
            ->where('idVisitante', $partida['idVisitante'])
            ->delete();
    }
}