<template>
    <div>
        <lista
            :campeonatos="campeonatos"
        ></lista>
    </div>
</template>

<script>
    import Lista from './Lista';
    
    export default {
        components: {
            'lista': Lista,
        },

        data() {
            return {
                campeonatos: []
            }
        },

        created() {
            this.getCampeonatos();
        },
        
        methods: {
            getCampeonatos: function() {
                axios.get('/api/v1/campeonato/campeonatos').then(response => {
                    this.campeonatos = response.data;
                });
            },
        }
    }
</script>