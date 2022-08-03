<template>
    <div>
		  <left-menu></left-menu>
      <top-menu></top-menu>
    </div>
</template>

<script>
	import LeftMenu from './LeftMenu';
	import TopMenu from './TopMenu';
    
    export default {
      components: {
        'left-menu': LeftMenu,
        'top-menu': TopMenu
      }
    }
</script>