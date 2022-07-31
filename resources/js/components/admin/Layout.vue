<template>
    <div>
		<left-menu></left-menu>
        <transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
    </div>
</template>

<script>
	import LeftMenu from './LeftMenu';
    
    export default {
        components: {
			'left-menu': LeftMenu
		}
    }
</script>