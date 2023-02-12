<template>
	<div class="position-relative">
		<Loading :showLoading="showLoading"/>
		<div>
			<Banner :country="country" :city="city" :unit="unit" :weather="weatherToday" :daily="weatherDaily" v-on:cityChange="cityChangeHandle"  v-on:loadingUpdate="loadingUpdateHandle"/>
			<NearbyPlaces :places="nearbyPlaces" v-on:loadingUpdate="loadingUpdateHandle"/>
		</div>
	</div>
</template>

<script>
import Banner from './Banner.vue'
import NearbyPlaces from './NearbyPlaces.vue'
import API from '../api'
import Loading from './Loading.vue'

export default {
	data() {
		return {
			country: 'Japan',
			city: 'Tokyo',
			units: 'imperial',
			unit: '°C',
			coord: {},
			weatherToday: {},
			weatherDaily: {},
			nearbyPlaces: [],
			showLoading: true
		}
	},
	components: {
		Banner,
		NearbyPlaces,
		Loading
	},
	methods: {
		loadingUpdateHandle: function(showLoading) {
			this.showLoading = showLoading
		},
		cityChangeHandle: function(city) {
			this.city = city
			this.getData()
		},
		getData: function() {
			Promise.all([
				API.get('weather_today', {
					params: {
						city: this.city,
						units: this.units
					}
				}),
				API.get('location_search', {
					params: {
						venue: this.city
					}
				})
			])
			.then(res => {
				let weather = res[0].data
				this.nearbyPlaces = res[1].data

				this.weatherToday = {
					id: weather.id,
					date: weather.date,
					temp: Math.round(weather.main.temp),
					humidity: weather.main.humidity,
					icon: 'https://openweathermap.org/img/w/'+weather.weather[0].icon+'.png',
					statusText: weather.weather[0].main,
					windDeg: weather.wind.deg,
					windSpeed: weather.wind.speed
				}
				this.coord = weather.coord

				API.get('weather_daily',{
					params: {
						lat: weather.coord.lat,
						lon: weather.coord.lon,
						units: this.units
					}
				})
				.then(res => {
					console.log(res)
					this.weatherDaily = res.data
				})
				.catch(err => {
					console.log(err)
				})
			})
			.catch(err => {
				console.log('error APP root')
				console.log(err)
			})
		}
	},
	mounted() {
		this.getData()
	}
}
</script>

<style>

</style>