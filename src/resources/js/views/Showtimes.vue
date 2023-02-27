<template>
    <div>
      <h3>Showtimes for selected movie and hall </h3>
      <Showtime
      v-for="showtime in showtimes"
      :key="showtime.id"
      :showtime="showtime"
      @childShowtimeSelected="selectShowtime"
    />
    </div>
  </template>

  <script>
  import Showtime from '../components/ShowtimeComponent.vue'

  export default {
    components: {
        Showtime
  },
  name: "Showtimes",
    props: {
      showtimes: Array
    },
    methods: {
        selectShowtime(showtime) {
        this.$emit('showtimeSelected', showtime)
      }
    }
  }
  </script>
