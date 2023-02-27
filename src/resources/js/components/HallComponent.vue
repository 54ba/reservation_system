<template>
    <div id="halls" class="card m-3">
      <div class="card-body">
        <h5 class="card-title">{{ hall.name }}</h5>
        <button class="btn btn-primary" @click="selectHall">Select</button>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: ['hall'],
    methods: {
      selectHall() {
        this.$emit('childHallSelected', this.hall)
      }
    }
  }
  </script>

