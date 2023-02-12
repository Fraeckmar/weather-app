<template>
  <div class="text-white rounded mt-3" :style="{backgroundImage: 'url(../images/banner.jpg)', backgroundSize: 'cover'}">
    <div class="rounded-top bg-dark">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h3 class="h3 m-0 p-2">{{country}}, {{city}} As of {{weatherToday.date}}</h3>
        </div>
        <div class="col-md-6 text-end">
          <select class="bg-dark text-white h3 m-0" v-model="city" @change="cityChangeHandle($event.target.value)">
            <option value="Yokohama">Yokohama</option>
            <option value="Tokyo">Tokyo</option>
            <option value="Kyoto">Kyoto</option>
            <option value="Osaka">Osaka</option>
            <option value="Sapporo">Sapporo</option>
            <option value="Nagoya">Nagoya</option>      
          </select>
        </div>
      </div>
    </div>
    <div class="p-3">
      <div class="row align-items-end">
        <div class="col-md-4">
          <div class="d-flex align-items-start">
            <h3 class="m-0" style="font-size: 6rem">{{ this.weatherToday.temp }} </h3>
            <span style="font-size: 3rem">{{ unit }}</span>
          </div>
          <div class="align-self-end mx-4">
            <p class="m-0">{{ weatherToday.statusText }}</p>     
            <img :src="weatherToday.icon"/>         
          </div>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div v-for="(weather, idx) of weatherDaily" :class="'col-sm-2 text-center border border-bottom-0 border-top-0 border-end-0 ' + (idx == 0 ? 'border-start-0' : '')">
              <span>{{ weather.date }}</span>
              <div class="d-flex align-items-start justify-content-center">
                <span>{{ weather.temp }}</span>
                <span style="font-size: 10px"> &nbsp;{{ unit }}</span> 
              </div>
              <img :src="weather.icon" />
            </div>
          </div>
        </div>
      </div>
    </div>
        
  </div>
</template>

<script>

export default {
  data(){
    return {
      weatherToday: {
        temp: 0
      },
      weatherDaily: {},
      city: this.city,
      unit: this.unit
    }
  },
  props: [
    'country',
    'city',
    'unit',
    'weather',
    'daily'
  ],
  methods: {
    cityChangeHandle(city){
      this.$emit('loadingUpdate', true)
      this.city = city
      this.$emit('cityChange', city)
    }
  },
  mounted() {
  },
  updated() {
    this.weatherToday = this.weather
    this.weatherDaily = this.daily
  }
}
</script>

<style>

</style>