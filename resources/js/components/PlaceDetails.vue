<template>
	<BreadCrumb />
	<div class="position-relative">
		<Loading :showLoading="showLoading"/>
		<div v-show="!showLoading">
			<h3 class="h3">{{ completeAddress }}</h3>
			<h5 class="my-3">Photos</h5>
			<div class="row px-3">
				<div class="col-sm-2 p-0" v-for="photoUrl of photos">
					<img :src="photoUrl" style="width: 100%"/>
				</div>
			</div>
			<h5 class="my-3">What other people say</h5>
			<ul class="list-group list-group-flush">
				<li v-for="tip of tips" class="list-group-item bg-transparent"> {{ tip }}  </li>
			</ul>
		</div>	
	</div>
</template>

<script>
import BreadCrumb from './BreadCrumb.vue'
import API from '../api'
import Loading from './Loading.vue'

export default {
	data() {
		return {
			completeAddress: '',
			photos: [],
			tips: [],
			showLoading: true
		}
	},
	components: {
		BreadCrumb,
		Loading
	},
	mounted() {
		let fsqId = this.$route.params.fsqId
		if (fsqId) {
			Promise.all([
				API.get('location_details', {
					params: {fsq_id: fsqId}
				}),
				API.get('location_photos', {
					params: {fsq_id: fsqId}
				}),
				API.get('location_tips', {
					params: {fsq_id: fsqId}
				})
			])
			.then(res => {
				console.log(res)
				this.completeAddress = res[0].data.location.formatted_address
				this.photos = res[1].data
				this.tips = res[2].data
				this.showLoading = false
			})
			.catch(err => {
				console.log(err)
			})
		}
	}
}
</script>

<style>

</style>