<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalPontos extends Model
{
    protected $table = 'total_pontos';
    public $timestamps = false;

    public function getTotalizado($idTime, $idTemporada, $numPartida)
    {
        return $this::where('idTime', $idTime)
            ->where('idTemporada', $idTemporada)
            ->where('numPartida', $numPartida)
            ->first();
    }

    public function getMaxPartida($idTemporada)
    {
        return $this::where('idTemporada', $idTemporada)
            ->max('numPartida');
    }
}
