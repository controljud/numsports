<template>
    <table class="table table-hover tblClassificacao">
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
            <tr v-for="(posicao, index) of posicoes" :key="index">
                <td class='center'>{{index + 1}}</td>
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
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" v-for="(resultado, index) of posicao.resultados" :key="index" class="btn btn-smi btn-light">
                            <img v-if="resultado.resultado == 3" src="images/check.png" class="imgResult"/>
                            <img v-if="resultado.resultado == 1" src="images/minus.png" class="imgResult"/>
                            <img v-if="resultado.resultado == 0" src="images/cancel.png" class="imgResult"/>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: [
            'posicoes'
        ],

        methods: {
            getClass(resultado) {
                if (resultado.resultado == 3) {
                    return 'btn btn-smi btn-success';
                } else if (resultado.resultado == 1) {
                    return 'btn btn-smi btn-secondary';
                } else {
                    return 'btn btn-smi btn-danger';
                }
            },

            getSymbol(resultado) {
                if (resultado.resultado == 3) {
                    return 'btn btn-smi btn-success';
                } else if (resultado.resultado == 1) {
                    return 'btn btn-smi btn-secondary';
                } else {
                    return 'btn btn-smi btn-danger';
                }
            }
        }
    }
</script>

<style>
.btn-smi {
    padding: 0.08rem 0.1rem;
    font-size: 0.475rem;
    line-height: 0.6;
    border-radius: 0.05rem;
}
</style>