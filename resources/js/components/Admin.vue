<template>
	<div>
		<top-menu></top-menu>
		<left-menu></left-menu>
		<dash-board></dash-board>
	</div>
</template>

<script>
	import TopMenu from './admin/TopMenu';
	import LeftMenu from './admin/LeftMenu';
	import DashBoard from './admin/DashBoard'

	export default {
		props: [
			'userName'
		],

		components: {
			'top-menu': TopMenu,
			'left-menu': LeftMenu,
			'dash-board': DashBoard
		}
	}
</script>