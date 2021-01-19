<template>
    <div>
        <layout></layout>
        <lista></lista>
    </div>
</template>

<script>
    import Layout from './../../admin/Layout';
    import Lista from './Lista'
    
    export default {
        components: {
            'layout': Layout,
            'lista': Lista
		}
    }
</script>