<template>
	<div class="mb-2 py-3 border border-start-0 border-end-0 border-top-0">
		<span v-for="(item, idx) in items" :key="idx"> 
			<span v-if="idx == items.length - 1"> 
				{{ item.label }} 
			</span>
			<a v-if="idx != items.length - 1" :href="item.path" class="text-link"> 
				{{ item.label }} 
			</a>
			<span v-if="idx != items.length - 1"> / </span>
		</span>
  </div>      
</template>

<script>

export default {
	data() {
		return {
			items: [
				{
					label: 'Home',
					path: '/'
				}
			]
		}
	},
	mounted() {
		for (let idx in this.$route.matched) {
			this.items.push({
				label: this.$route.matched[idx].meta.label,
				path: this.$route.matched[idx].path
			})
		}
		console.log(this.items)
		console.log(this.$route.matched)
		console.log(this.$route)

	}
}
</script>

<style>

</style>