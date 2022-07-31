<template>
	<div>
		<layout></layout>
		<transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
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