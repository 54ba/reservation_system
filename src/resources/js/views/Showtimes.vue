<template>
    <div>
        <Showtime v-for="showtime in showtimes" :key="showtime.id" :showtime="showtime"
            @childShowtimeSelected="handleShowtimeSelection" />
        <div v-if="selectedShowtime">
            <Seats :seats="seats" />
        </div>
    </div>
</template>

<script>
import Showtime from '../components/ShowtimeComponent.vue'
import Seats from '../views/Seats.vue'

export default {
    components: {
        Showtime,
        Seats,
    },
    data() {
        return {
            // Hold the state
            selectedShowtime: null,
            seats: []
        };
    },
    name: "Showtimes",
    props: ['showtimes'],
    methods: {

        // Method to update the state when a time is selected
        handleShowtimeSelection(showtime) {
            this.selectedShowtime = showtime;
            this.getSeats(showtime.movie_id, showtime.hall_id, showtime.id);

        },

        // Method to make the API call to get the seats for a movie, hall, and time
        async getSeats(movieId, hallId, showtimeId) {
            try {
                const response = await axios.get(
                    process.env.MIX_API_URL + `/receptionist/seats/${movieId}/${hallId}/${showtimeId}`
                );
                this.seats = response.data.seats;
                return response.data.seats;

            } catch (error) {
                console.error(error);
            }
        },

    }
}
</script>
