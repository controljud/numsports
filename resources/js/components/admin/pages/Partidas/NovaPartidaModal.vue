<template>
    <transition name="novaPartidaModal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-success" @click="$emit('closeNovaPartidaModal')"></button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {

    }
</script>
