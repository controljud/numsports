<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dados Numsports</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3" @click="openPartidas()">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Partidas</span>
                                <span class="info-box-number">1242</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3" @click="openTimes()">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Times</span>
                                <span class="info-box-number">32</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Temporadas</span>
                                <span class="info-box-number">5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-trophy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Campeonatos</span>
                                <span class="info-box-number">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import router from '../../router';

    export default {
        methods: {
            openPartidas() {
                router.push('/admin/partidas');
            },

            openTimes() {
                router.push('/admin/times');
            },
        }
    }
</script>

<style>
.info-box {
    cursor: pointer;
}
</style>