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
	import Dashboard from './admin/Dashboard';

	export default {
		props: [
			'userName'
		],

		components: {
			Layout,
			Dashboard
		}
	}
</script>