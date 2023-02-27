<template>
    <div>
      <h3>Halls</h3>
      <Hall
      v-for="hall in halls"
      :key="hall.id"
      :hall="hall"
      @childHallSelected="selectHall"
    />
    </div>
  </template>

  <script>
  import Hall from '../components/HallComponent.vue'

  export default {
    components: {
    Hall
  },
    name: "Halls",
    props: {
      halls: Array
    },
    methods: {
        selectHall(hall) {
        this.$emit("hallSelected", hall);
      }
    }
  };
  </script>
