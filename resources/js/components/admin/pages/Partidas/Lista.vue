<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Lista - arrumar</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Campeonato</label>
                        <v-select :options="campeonatos" v-model="campeonato" label="nome" code="id" @input="getTemporadas"></v-select>
                    </div>
                    <div class="col-md-4">
                        <label>Temporada</label>
                        <v-select :options="temporadas" v-model="temporada" label="temporada" code="id"></v-select>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2" style="text-align: right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                            Nova
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css'
    
    export default {
        props: [
            'campeonatos'
        ],

        components: {
            vSelect
		},
        
        data() {
            return {
                campeonato: null,
                temporadas: [],
                temporada: null
            }
        },
        
        methods: {
            getTemporadas: function() {
                console.log(this.campeonato);
                if (this.campeonato != null) {
                    axios.get('/numsports/public/api/v1/campeonato/temporadas/' + this.campeonato.id).then(response => {
                        this.temporadas = response.data;
                    });
                } else {
                    this.temporadas = [];
                }
            },

            getPartidas: function() {

            }
        }
    }
</script>