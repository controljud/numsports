<template>
  <div>
    <simple-modal v-model="isShow" title="Modal Header">
        <template slot="body">
            <h2>My modal</h2>
            <input>
            <p>Hello you</p>
        </template>
        <template slot="footer">
            <button>OK</button>
        </template>
    </simple-modal>
    <button @click="isShow = !isShow">on off button</button>
  </div>
</template>
 
<script>
    import SimpleModal from 'simple-modal-vue'
    export default {
        name: 'SimpleModalExample',
        components: { SimpleModal },
        data() {
            return { 
                isShow: true
            }
        },
    }
</script> 