<template>
	<div class="container">
        <div class="row">
            <div v-if="campeonato" class="col-md-12">
                <h3>{{campeonato.nome}} {{campeonato.sexo}} {{campeonato.divisao}}</h3>
                <h5>Temporada {{campeonato.temporada}}</h5>
                <p>Classificação</p>
            </div>
        </div>
		<div class="row" v-if="posicoes.length > 0">
            <div class="col-md-12">
                <table class="table tblClassificacao">
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
                            <th class='center'>Últimas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="posicao of posicoes" v-bind:key="posicao">
                            <td class='center'>{{posicao.posicao}}</td>
                            <td><a href="javascript:void(0)">{{posicao.nomeTime}}</a></td>
                            <td class='center'>{{posicao.pontos}}</td>
                            <td class='center'>{{posicao.numPartida}}</td>
                            <td class='center'>{{posicao.vitorias}}</td>
                            <td class='center'>{{posicao.empates}}</td>
                            <td class='center'>{{posicao.derrotas}}</td>
                            <td class='center'>{{posicao.golsFeitos}}</td>
                            <td class='center'>{{posicao.golsSofridos}}</td>
                            <td class='center'>{{posicao.saldo}}</td>
                            <td class='center'>
                                <span v-for="resultado of posicao.resultados" v-bind:key="resultado">
                                    <img v-if="resultado.resultado == 3" src="images/check.png" class="imgResult"/>
                                    <img v-if="resultado.resultado == 1" src="images/minus.png" class="imgResult"/>
                                    <img v-if="resultado.resultado == 0" src="images/cancel.png" class="imgResult"/>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" v-if="posicoes.length > 0">
            <div class="col-md-12">
                <a href="javascript:void(0);" class="btn btn-md btn-success">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                    Rodada a rodada
                </a>
            </div>
        </div>
	</div>
    
</template>

<script>
    import axios from 'axios';
    import PosicaoDinamica from './PosicaoDinamica';

    export default {
        components: {
			'posicao-dinamica': PosicaoDinamica
        },
        
		data() {
            return {
                campeonato: null,
                posicoes: [],
                maxPartidas: 0,
                posicaoInicial: 1,
                x: 1,
                posicaoDinamica: false
            }
        },

        created() {
            axios.get('/numsports/public/api/v1/campeonato/posicao/geral').then(response => {
                this.posicoes = response.data.posicao_geral;
                this.maxPartidas = response.data.max_partidas;
                this.campeonato = response.data.campeonato;
            });
        }
    }
</script>