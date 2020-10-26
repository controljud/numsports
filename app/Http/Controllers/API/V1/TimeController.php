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

class TimeController extends Controller
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

    public function getUltimosResultados(Request $request, $idTemporada, $idTime)
    {
        $idTemporada = 1;
        $resultados = $this->partida->getUltimosResultados($idTemporada, $idTime);

        return response()->json(['resultados' => $resultados]);
    }
}