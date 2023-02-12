<template>
	<div class="text-center p-2 border h-100 mx-1">
		<div class="d-flex justify-content-center align-items-end">
			<div v-for="icon of placeData.icons" class="d-flex m-1 border bg-dark">
				<img :src="icon" width="30">
			</div>
		</div>
		<h4 class="h4 m-0">{{ placeData.name }}</h4>
	</div>
</template>

<script>
export default {
	props: ['placeData']
}
</script>

<style>

</style>