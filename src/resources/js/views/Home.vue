
<script setup>
import axios from 'axios';
import Halls from '../views/Halls.vue'
import Movies from '../views/Movies.vue'
import Seats from '../views/Seats.vue'
import Confirm from '../views/Confirm.vue'
import Showtimes from '../views/Showtimes.vue';
import Header from "../components/Header.vue";


</script>

<template>
    <Header />
    <Movies :movies="movies" @movieSelected="handleMovieSelection" />
    <div v-if="selectedMovie">
      <halls :halls="halls" @hallSelected="handleHallSelection"/>
      <div v-if="selectedHall">
        <Showtimes :showtimes="showtimes" @showtimeSelected="handleShowtimeSelection"/>
      </div>
      <div v-if="selectedShowtime">
        <Seats :seats="seats" @seatReserved="handleSeatReservation"
                @seatCanceled="handleSeatCancelation" />

      </div>
    </div>

</template>


<script>

export default {
  components: {
    Header,
    Movies,
    Halls,
    Showtimes,
    Seats

  },
  data() {
    return {
      // Hold the state for the entire application

        selectedMovie: null,
        selectedHall: null,
        selectedShowtime: null,
        selectedSeat: [],
        showtimes: [],
        halls: [],
        movies: [],
        seats: [],

    };
  },

  methods: {
    // Method to update the state when a movie is selected

    handleMovieSelection(movie) {
      this.selectedMovie = movie
      this.getHalls(movie.id)
    },


    // Method to update the state when a hall is selected
    handleHallSelection(hall) {
      this.selectedHall = hall;
      this.getShowtimes(this.selectedMovie.id,hall.id)

    },
    // Method to update the state when a time is selected
    handleShowtimeSelection(showtime) {
      this.selectedShowtime = showtime;
      this.getSeats(this.selectedMovie.id,this.selectedHall.id,this.selectedShowtime.id);

    },
    handleSeatReservation(seat) {
      this.selectedSeat = seat;
      this.reserveSeat(this.selectedMovie.id,this.selectedHall.id,this.selectedShowtime.id,seat.id)


    },

     handleSeatCancelation(seat) {
      this.selectedSeat = seat;
      this.cancelSeat(this.selectedMovie.id,this.selectedHall.id,this.selectedShowtime.id,seat.id)

    },
    // Method to make the API call to get the showtimes for a movie and hall
    async getShowtimes(movieId, hallId) {
      try {
        const response = await axios.get(
            process.env.MIX_API_URL+`/receptionist/showtimes/${movieId}/${hallId}`
        );
        this.showtimes = response.data.showtimes;
        return response.data.showtimes;
      } catch (error) {
        console.error(error);
      }
    },
    // Method to make the API call to get the halls for a movie
    async getHalls(movieId) {
      try {
        const response = await axios.get(process.env.MIX_API_URL+`/receptionist/halls/${movieId}`);
        this.halls = response.data.halls;
        return response.data.halls;
    } catch (error) {
        console.error(error);
      }
    },
    // Method to make the API call to get the movies
    async getMovies() {
      try {
        const response = await axios.get(process.env.MIX_API_URL+`/receptionist/movies`);
        this.movies = response.data.movies;
        return response.data.movies;

      } catch (error) {
        console.error(error);
      }
    },
    // Method to make the API call to get the seats for a movie, hall, and time
    async getSeats(movieId, hallId, showtimeId) {
      try {
        const response = await axios.get(
            process.env.MIX_API_URL+ `/receptionist/seats/${movieId}/${hallId}/${showtimeId}`
        );
        this.seats = response.data.seats;
        return response.data.seats;

      } catch (error) {
        console.error(error);
      }
    },

    async reserveSeat(movieId, hallId, showtimeId,seatId) {
      try {

        const response = await axios.post(
            process.env.MIX_API_URL+ `/receptionist/reserve/`,
            {
            movie_id:movieId,
            hall_id:hallId,
            showtime_id:showtimeId,
            seat_id:seatId
        }

        );
        if (response.data.seat ){
            this.selectedSeat =  response.data.seat
        }

      } catch (error) {
        console.error(error);
      }
    },
    async cancelSeat(movieId, hallId, showtimeId,seatId) {
      try {
        const response = await axios.post(
            process.env.MIX_API_URL+ `/receptionist/cancel/`,
            {
            movie_id:movieId,
            hall_id:hallId,
            showtime_id:showtimeId,
            seat_id:seatId
        }

        );
         if (response.data.seat ){
            this.selectedSeat = response.data.seat;

         }

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

