<template>
	<div v-show="places.length">
		<h3 class="my-3">Nearby Places</h3>
		<div class="row px-3">
			<div class="col-sm-2 p-0 my-1" v-for="place of places">
				<NearbyPlaceItem :placeData="place"  role="button" @click="clickHandle(place.fsqId)"/>
			</div>
		</div>		
	</div>
</template>

<script>
import NearbyPlaceItem from './NearbyPlaceItem.vue'

export default {
	data() {
		return {
			showLoading: true
		}
	},
	props: ['places'],
	components: {
		NearbyPlaceItem
	},
	methods: {
		clickHandle: function(fsqId) {
			this.$router.push({
				name: 'place.details', 
				params: {fsqId: fsqId}
			})
		}
	},
	updated() {
		if (this.places.length) {
			console.log('emit')
			this.$emit('loadingUpdate', false)
		}
	}
}
</script>

<style>

</style>