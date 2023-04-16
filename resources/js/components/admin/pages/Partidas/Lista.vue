<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Partidas</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Campeonato</label>
                        <v-select :options="campeonatos" v-model="campeonato" label="nome" code="id" @input="getTemporadas"></v-select>
                    </div>
                    <div class="col-md-4">
                        <label>Temporada</label>
                        <v-select :options="temporadas" v-model="temporada" label="temporada" code="id" @input="getPartidas"></v-select>
                    </div>
                    <div class="col-md-2" style="text-align: right; padding-top: 30px">
                        <a v-if="partidas.data" href="javascript:void(0)" class="btn btn-sm btn-primary" @click="showNovaPartidaModal">
                            <i class="fa fa-plus"></i>
                            Nova
                        </a>
                    </div>
                    <div class="col-md-2" style="text-align: right; padding-top: 30px">
                        <a v-if="partidas.data" href="javascript:void(0)" class="btn btn-sm btn-success" v-on:click="importPartidas">
                            <i class="fa fa-download"></i>
                            Importar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div v-if="partidas.data">
                    <div class="row" v-if="nova">
                        <div class="col-md-12">
                            <hr/>
                            <h3>Nova Partida</h3>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Data</label>
                                    <input type="datetime-local" v-model="partida.data" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label>Mandante</label>
                                    <v-select :options="times" v-model="partida.mandante" label="nome" code="id" style="margin-top: 3px"></v-select>
                                </div>
                                <div class="col-md-2">
                                    <label>Visitante</label>
                                    <v-select :options="times" v-model="partida.visitante" label="nome" code="id" style="margin-top: 3px"></v-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <label>Gols Mandante</label>
                                    <input type="number" v-model="partida.placarMandante" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label>Gols Visitante</label>
                                    <input type="number" v-model="partida.placarVisitante" class="form-control">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-4">
                                    <a href="javascript:void(0)" class="btn btn-light btn-sm" v-on:click="cadastrarPartida(false)">
                                        Cancelar
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm" v-on:click="cadastrarPartida(true)">
                                        <i class="fa fa-save"></i> Salvar
                                    </a>
                                </div>
                            </div>
                            <hr/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 85px">Data</th><th class="right">Mandante</th><th></th><th></th><th></th><th>Visitante</th><th style="width: 75px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(partida, index) of partidas.data" :key="index">
                                        <td>{{format_date(partida.data)}}</td>
                                        <td class="right">{{partida.mandante}}</td>
                                        <td class="center">{{partida.placarMandante}}</td>
                                        <td class="center">X</td>
                                        <td class="center">{{partida.placarVisitante}}</td>
                                        <td>{{partida.visitante}}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary" title="Editar" v-on:click="editarPartida(partida)">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" title="Excluir" v-on:click="excluirPartida(partida)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" v-if="partidas.last_page && partidas.last_page > 1">
                        <div class="col-md-6">
                            Mostrando página <b>{{partidas.current_page}}</b> de <b>{{partidas.last_page}}</b>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary" v-if="partidas.current_page > 1" v-on:click="getPartidasUrl(partidas.first_page_url)">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                    <i class="fa fa-fast-backward"></i>
                                </label>
                                <label class="btn btn-secondary" v-if="partidas.current_page > 1" v-on:click="getPartidasUrl(partidas.path + '?page=' + (partidas.current_page - 1))">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                    <i class="fa fa-backward"></i>
                                </label>
                                <label class="btn btn-secondary active" v-on:click="getPartidasUrl(partidas.path + '?page=1')">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> 1
                                </label>
                                <label class="btn btn-secondary" v-if="partidas.last_page > 1" v-on:click="getPartidasUrl(partidas.path + '?page=2')">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> 2
                                </label>
                                <label class="btn btn-secondary" v-if="partidas.last_page > 8">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> ...
                                </label>
                                <label class="btn btn-secondary" v-if="(partidas.last_page - 3) > 8" v-on:click="getPartidasUrl(partidas.path + '?page=' + (partidas.last_page - 1))">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> {{partidas.last_page - 1}}
                                </label>
                                <label class="btn btn-secondary" v-if="(partidas.last_page - 3) > 8" v-on:click="getPartidasUrl(partidas.path + '?page=' + (partidas.last_page))">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> {{partidas.last_page}}
                                </label>
                                <label class="btn btn-secondary" v-if="partidas.current_page < partidas.last_page" v-on:click="getPartidasUrl(partidas.path + '?page=' + (partidas.current_page + 1))">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                    <i class="fa fa-forward"></i>
                                </label>
                                <label class="btn btn-secondary" v-if="partidas.current_page < partidas.last_page" v-on:click="getPartidasUrl(partidas.last_page_url)">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                    <i class="fa fa-fast-forward"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <nova-partida-modal 
            v-if="novaPartidaModal"
            @closeNovaPartidaModal="closeNovaPartidaModal"
        ></nova-partida-modal>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    import moment from 'moment';
    import NovaPartidaModal from './NovaPartidaModal.vue';
    
    export default {
        props: [
            'campeonatos'
        ],

        components: {
            vSelect,
            moment,
            'nova-partida-modal': NovaPartidaModal
		},
        
        data() {
            return {
                campeonato: null,
                temporadas: [],
                temporada: null,
                partidas: [],
                partidaUrl: null,
                nova: false,
                partida: {
                    idTemporada: null,
                    data: null,
                    mandante: null,
                    placarMandante: null,
                    placarVisitante: null,
                    visitante: null
                },
                times: [],
                novaPartidaModal: false
            }
        },
        
        methods: {
            showNovaPartidaModal: function() {
                this.novaPartidaModal = true;
            },

            closeNovaPartidaModal: function() {
                this.novaPartidaModal = false;
            },

            getTemporadas: function() {
                if (this.campeonato != null) {
                    axios.get('/api/v1/campeonato/temporadas/' + this.campeonato.id).then(response => {
                        this.temporadas = response.data;
                    });
                } else {
                    this.temporadas = [];
                }
            },

            getPartidasUrl: function(url) {
                this.partidaUrl = url;
                this.getPartidas();
            },

            getPartidas: function() {
                let url = '/api/v1/partida/partidas/' + this.temporada.id
                
                if (this.partidaUrl != null) {
                    url = this.partidaUrl;
                }
                
                if (this.campeonato != null) {
                    axios.get(url).then(response => {
                        this.partidas = response.data;
                    });
                } else {
                    this.partidas = [];
                }
            },

            openCadastro(){
                axios.get('/api/v1/time/times').then(response => {
                    this.times = response.data;
                });
                this.nova = true;
            },

            editarPartida(partida){
                this.partida = partida;
                this.nova = true;
            },

            excluirPartida(partida){
                partida.idTemporada = this.temporada.id;
                
                axios.post('/api/v1/partida/delete', partida).then(response => {
                    this.getPartidas();
                    alert('Partida excluída com sucesso');
                });
            },

            cadastrarPartida(salvar){
                if (salvar) {
                    this.partida.idTemporada = this.temporada.id;
                    
                    axios.post('/api/v1/partida', this.partida).then(response => {
                        let retorno = response.data;

                        this.zeraPartida();
                        this.getPartidas();
                    });
                } else {
                    this.nova = false;
                }
            },

            importPartidas() {
                
            },

            format_date(value){
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY');
                }
            },

            zeraPartida(){
                this.partida.idTemporada = null;
                this.partida.mandante = null;
                this.partida.placarMandante = null;
                this.partida.placarVisitante = null;
                this.partida.visitante = null;
            }
        }
    }
</script>

<style scoped>
    .table td, .table th {
        padding: 2px !important;
    }

    .right {
        text-align: right;
    }

    .center {
        text-align: center;
    }
</style>