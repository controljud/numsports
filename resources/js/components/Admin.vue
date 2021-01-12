<template>
	<div>
		<layout></layout>
		<dash-board></dash-board>
	</div>
</template>

<script>
	import Layout from './admin/Layout';
	import DashBoard from './admin/DashBoard';

	export default {
		props: [
			'userName'
		],

		components: {
			Layout,
			DashBoard
		}
	}
</script>