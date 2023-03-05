
<script setup>
import axios from 'axios';
import Halls from '../views/Halls.vue'
import Movies from '../views/Movies.vue'
import Header from "../components/Header.vue";
import MovieDetails from '../components/MovieDetails.vue';


</script>

<template>
    <div class="container-fluid  ">
        <Header />
        <div class="box app row d-flex justify-content-center">
            <div class="left-panel col-md-4 ">
                <template v-if="selectedMovie">
                    <Movies :movies="movies" :selected_movie_id="selectedMovie.id" @movieSelected="handleMovieSelection" />
                </template>
                <template v-else>
                    <Movies :movies="movies" @movieSelected="handleMovieSelection" />
                </template>
            </div>

            <div id="right-panel" v-if="selectedMovie" class="right-panel col-md-6">

                <MovieDetails :movie="selectedMovie" />

                <halls :halls="halls" />


            </div>
        </div>
    </div>
</template>


<script>

export default {
    components: {
        Header,
        Movies,
        Halls,
        MovieDetails

    },
    data() {
        return {
            // Hold the state
            selectedMovie: null,
            halls: [],
            movies: [],

        };
    },

    methods: {
        // Method to update the state when a movie is selected

        handleMovieSelection(movie) {
            this.selectedMovie = movie
            this.getHalls(movie.id)
        },
        // Method to make the API call to get the movies
        async getMovies() {
            try {
                const response = await axios.get(process.env.MIX_API_URL + `/receptionist/movies`);
                this.movies = response.data.movies;
                return response.data.movies;

            } catch (error) {
                console.error(error);
            }
        },

        // Method to make the API call to get the halls for a movie
        async getHalls(movieId) {
            try {
                const response = await axios.get(process.env.MIX_API_URL + `/receptionist/halls/${movieId}`);
                this.halls = response.data.halls;
                return response.data.halls;
            } catch (error) {
                console.error(error);
            }
        }
    },
    async mounted() {

        console.log("movies mounted");
        const data = await this.getMovies();
        this.movies = data;
    }

}
</script>

<style>
.navbar {
    margin-bottom: 20px;
}
</style>

