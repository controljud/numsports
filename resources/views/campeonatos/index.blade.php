@extends('layout')

@section('content')

<input type="hidden" value="{{$idTemporada}}" id="idTemporada" />
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <table class='tblClassificacao table-striped'>
                    <thead>
                        <tr>
                            <th class='center'>Posição</th>
                            <th class='center'>Time</th>
                            <th class='center'>Pontos</th>
                            <th class='center'>Jogos</th>
                            <th class='center'>Vitórias</th>
                            <th class='center'>Empates</th>
                            <th class='center'>Derrotas</th>
                            <th class='center'>GF</th>
                            <th class='center'>GS</th>
                            <th class='center'>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <input type='hidden' value='{{$x = 1}}' />
                    @foreach($posicaoGeral as $posicao)
                        <tr>
                            <td>{{$x++}}</td>
                            <td><a href="javascript:void(0)" class="aJogosTime" id="{{$idTemporada}}-{{$posicao->idTime}}">{{$posicao->nomeTime}}</a></td>
                            <td class='center'>{{$posicao->pontos}}</td>
                            <td class='center'>{{$posicao->numPartida}}</td>
                            <td class='center'>{{$posicao->vitorias}}</td>
                            <td class='center'>{{$posicao->empates}}</td>
                            <td class='center'>{{$posicao->derrotas}}</td>
                            <td class='center'>{{$posicao->golsFeitos}}</td>
                            <td class='center'>{{$posicao->golsSofridos}}</td>
                            <td class='center'>{{$posicao->saldo}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id='line_top_x'></div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection