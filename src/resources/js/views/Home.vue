
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
        <template v-if="selectedMovie">
            <div class="box app row d-flex justify-content-center">

                <div class="left-panel col-md-4">
                    <Movies :movies_count="count" :movies_total="total" :movies="movies"
                        :selected_movie_id="selectedMovie.id" @movieSelected="handleMovieSelection" />
                </div>

                <div id="right-panel" class="right-panel col-md-6">

                    <MovieDetails :movie="selectedMovie" />

                    <halls :halls="halls" />
                </div>
            </div>
        </template>

        <template v-else>
            <div class="box app row d-flex justify-content-center">
                <div class="left-panel col-md-8">
                    <Movies :movies_count="count" :movies_total="total" :movies="movies"
                        @movieSelected="handleMovieSelection" />
                </div>
            </div>
        </template>

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
            total: null,
            count: null,
            per_page: null,
            current_page: null,
            total_pages: null

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
                this.total = response.data.total;
                this.count = response.data.count;
                this.per_page = response.data.per_page;
                this.current_page = response.data.current_page;
                this.total_pages = response.data.total_pages;


                return response.data;

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

        console.log("mounted");
        await this.getMovies();
    }

}
</script>

<style>
.navbar {
    margin-bottom: 20px;
}
</style>

