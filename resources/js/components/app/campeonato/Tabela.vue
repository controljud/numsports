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
            <tr v-for="posicao of posicoes" :key="posicao.idTime">
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
                    <span v-for="(resultado, index) of posicao.resultados" ey="index">
                        <img v-if="resultado.resultado == 3" src="images/check.png" class="imgResult"/>
                        <img v-if="resultado.resultado == 1" src="images/minus.png" class="imgResult"/>
                        <img v-if="resultado.resultado == 0" src="images/cancel.png" class="imgResult"/>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: [
            'posicoes'
        ]
    }
</script>