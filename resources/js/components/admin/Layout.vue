<template>
    <div>
		<top-menu></top-menu>
		<left-menu></left-menu>
        <transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
    </div>
</template>

<script>
    import TopMenu from './TopMenu';
	import LeftMenu from './LeftMenu';
    
    export default {
        components: {
			'top-menu': TopMenu,
			'left-menu': LeftMenu
		}
    }
</script>