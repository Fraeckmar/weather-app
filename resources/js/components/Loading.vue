<template>
	<div v-show="show">
		<div style="background-color: #0000003d" class="d-flex align-items-center my-2 min-vh-100 position-absolute start-0 top-0 w-100 container justify-content-center text-white">
			<div class="spinner-border" role="status">
				<span class="sr-only"></span>
			</div>
		</div>
	</div>	
</template>

<script>
export default {
	data() {
		return {
			show: this.showLoading
		}
	},
	props: ['showLoading'],
	updated() {
		this.show = this.showLoading
		console.log('show')
		console.log(this.show)
	}
}
</script>

<style>

</style>