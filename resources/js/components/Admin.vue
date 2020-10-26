<template>
	<div>
		<top-menu></top-menu>
		<app-body></app-body>
		<app-footer></app-footer>
	</div>
</template>

<script>
	import TopMenu from './home/TopMenu.vue';
	//import AppBody from './home/AppBody.vue';
	//import AppFooter from './home/AppFooter.vue';

	export default {
		components: {
			'top-menu': TopMenu,
			//'top-menu': AppBody,
			//'app-footer': AppFooter
		}
	}
</script>