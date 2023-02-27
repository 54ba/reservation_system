<template>
   <div>
    <h2>Movies</h2>
    <div class="row">
      <div class="col-4" v-for="movie in movies" :key="movie.id">
        <Movie @childMovieSelected="selectMovie" :movie="movie"/>
      </div>
    </div>
  </div>
  </template>

  <script>
    import Movie from '../components/MovieComponent.vue';

  export default {
    components: {
        Movie
  },

    name: 'Movies',
    props: ['movies'],
    methods: {
        selectMovie(movie) {
        this.$emit('movieSelected', movie);
      },
    },
  };
  </script>
