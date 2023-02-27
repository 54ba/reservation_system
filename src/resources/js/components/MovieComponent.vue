<template>
    <div id="movies" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ movie.name }}</h5>
        <h5 class="card-title">{{ movie.description }}</h5>

        <button class="btn btn-primary" @click="selectMovie">Select</button>
      </div>
    </div>
  </template>

  <script>

  export default {
    props: ['movie'],
    methods: {
      selectMovie() {
        this.$emit('childMovieSelected', this.movie)
      }
    }
  }
  </script>

  <style>
  .card {
    width: 18rem;
    margin: 1rem;
    display: inline-block;
  }
  </style>
