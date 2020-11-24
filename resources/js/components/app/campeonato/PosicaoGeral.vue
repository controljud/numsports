<template>
	<div class="container">
        <div class="row">
            <div v-if="campeonato" class="col-md-12">
                <div class="row">
                    <div v-if="campeonato" class="col-md-12">
                        <h3>{{campeonato.nome}} {{campeonato.sexo}} {{campeonato.divisao}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <b>Temporada</b>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-10">
                                <v-select :options="temporadas" v-model="temporada" label="temporada" @input="setTemporadaAtiva(false)"></v-select>
                            </div>
                            <div class="col-md-2">
                                <div class="spinner-border text-success" role="status" v-show="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Classificação</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" v-if="posicoes.length > 0" style="margin-bottom: 10px;">
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

		<div class="row" v-if="posicoes.length > 0">
            <div class="col-md-12">
                <line-chart 
                    v-if="showGrafico"
                    v-bind:graphLabels="graphLabels"
                    v-bind:graphDataset="graphDataset"
                    ref="line_chart"
                />
                <tabela
                    v-show="showTabela"
                    v-bind:posicoes="posicoes"
                />
                <a href="javascript:void(0);" class="btn btn-sm btn-secondary" v-show="showGrafico" v-on:click="marcarDesmarcarTodos">
                    {{mark}}
                </a>
            </div>
        </div>
	</div>
</template>

<script>
    import Tabela from './Tabela'
    import LineChart from './../../comuns/charts/LineChart'
    
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css'

    export default {
        components: {
            Tabela,
            LineChart,
            vSelect
        },

		data() {
            return {
                graphLabels: null,
                graphDataset: null,
                campeonato: null,
                posicoes: [],
                maxPartidas: 0,
                temporadas: null,
                showTabela: true,
                showGrafico: false,
                mark: "Desmarcar todos",
                allMarked: true,
                temporada: null,
                loading: true
            }
        },

        created() {
            this.getTemporadas();
        },

        methods: {
            getPosicaoDinamica: function(idTemporada) {
                axios.get('/numsports/public/api/v1/campeonato/posicao/dinamica/' + idTemporada).then(response => {
                    this.graphLabels = response.data.labels;
                    this.graphDataset = response.data.dataset;
                });
            },

            getPosicaoGeral: function(idTemporada) {
                axios.get('/numsports/public/api/v1/campeonato/posicao/geral/' + idTemporada).then(response => {
                    this.posicoes = response.data.posicao_geral;
                    this.maxPartidas = response.data.max_partidas;
                    this.campeonato = response.data.campeonato;

                    this.loading = false;
                });
            },

            getTemporadas: function() {
                axios.get('/numsports/public/api/v1/campeonato/temporadas').then(response => {
                    this.temporadas = response.data;
                    this.setTemporadaAtiva(true);
                });
            },

            openTabela: function() {
                this.showTabela = true;
                this.showGrafico = false;
            },

            openGrafico: function() {
                this.showTabela = false;
                this.showGrafico = true;
                this.markAll = true;
            },

            marcarDesmarcarTodos: function() {
                this.$refs.line_chart.unSelectAll();
            },

            setTemporadaAtiva: function(ativa) {
                this.loading = true;
                if (ativa) {
                    this.temporada = this.temporadas.filter(function(tp){
                        return tp.status == 1;
                    })[0];
                }

                this.getPosicaoGeral(this.temporada.id);
                this.getPosicaoDinamica(this.temporada.id);
                this.openTabela();
            },
        }
    }
</script>