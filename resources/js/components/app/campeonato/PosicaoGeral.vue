<template>
	<div class="container">
        <div class="row">
            <div v-if="campeonato" class="col-md-12">
                <h3>{{campeonato.nome}} {{campeonato.sexo}} {{campeonato.divisao}}</h3>
                <h5>Temporada {{campeonato.temporada}}</h5>
                <p>Classificação</p>
            </div>
        </div>
        
        <div class="row" v-if="posicoes.length > 0" style="margin-botton: 10px;">
            <div class="col-md-12">
                <a href="javascript:void(0);" class="btn btn-md btn-light" v-show="showTabela" v-on:click="openGrafico">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                    Rodada a rodada
                </a>
                <a href="javascript:void(0);" class="btn btn-md btn-light" v-show="showGrafico" v-on:click="openTabela">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                    Posião Geral
                </a>
            </div>
        </div>

		<div class="row" v-if="posicoes.length > 0" style="margin-botton">
            <div class="col-md-12">
                <line-chart v-if="showGrafico"/>
                <tabela
                    v-show="showTabela"
                    v-bind:posicoes="posicoes"
                ></tabela>
            </div>
        </div>
	</div>
</template>

<script>
    import Tabela from './Tabela'
    import LineChart from './../../comuns/charts/LineChart'

    export default {
        components: {
            Tabela,
            LineChart
        },

		data() {
            return {
                campeonato: null,
                posicoes: [],
                maxPartidas: 0,
                posicaoInicial: 1,
                x: 1,
                posicaoDinamica: false,
                showTabela: true,
                showGrafico: false
            }
        },

        created() {
            this.atualiarDados();
        },

        methods: {
            atualiarDados: function() {
                axios.get('/numsports/public/api/v1/campeonato/posicao/geral').then(response => {
                    this.posicoes = response.data.posicao_geral;
                    this.maxPartidas = response.data.max_partidas;
                    this.campeonato = response.data.campeonato;
                });
            },

            openTabela: function() {
                this.showTabela = true;
                this.showGrafico = false;
            },

            openGrafico: function() {
                this.showTabela = false;
                this.showGrafico = true;
            }
        }
    }
</script>