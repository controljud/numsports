<template>
	<div>
		<top-menu></top-menu>
		<app-body></app-body>
	</div>
</template>

<script>
	import TopMenu from './app/TopMenu.vue';
	import AppBody from './app/AppBody.vue';
	//import AppFooter from './app/AppFooter.vue';

	export default {
		components: {
			'top-menu': TopMenu,
			'app-body': AppBody,
			//'app-footer': AppFooter
		}
	}
</script>