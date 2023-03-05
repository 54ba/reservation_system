<template>
    <div>
        <Seat v-for="seat in seats" :key="seat.id" :seat="seat" @childSeatReserved="handleSeatReservation"
            @childSeatCanceled="handleSeatCancelation" />

    </div>
</template>

<script>
import Seat from '../components/SeatComponent.vue'
// import Confirm from '../views/Confirm.vue'

export default {
    components: {
        Seat
    },
    data() {
        return {
            // Hold the state
            selectedSeat: null,
        };
    },
    props: ['seats'],
    methods: {
        handleSeatReservation(seat) {
            this.selectedSeat = seat;
            this.reserveSeat(seat.movie_id, seat.showtime_id.hall_id, seat.showtime_id, seat.id)


        },

        handleSeatCancelation(seat) {
            this.selectedSeat = seat;
            this.cancelSeat(seat.movie_id, seat.showtime_id.hall_id, seat.showtime_id, seat.id)

        },


        async reserveSeat(movieId, hallId, showtimeId, seatId) {
            try {

                const response = await axios.post(
                    process.env.MIX_API_URL + `/receptionist/reserve/`,
                    {
                        movie_id: movieId,
                        hall_id: hallId,
                        showtime_id: showtimeId,
                        seat_id: seatId
                    }

                );
                if (response.data.seat) {
                    this.selectedSeat = response.data.seat
                }

            } catch (error) {
                console.error(error);
            }
        },
        async cancelSeat(movieId, hallId, showtimeId, seatId) {
            try {
                const response = await axios.post(
                    process.env.MIX_API_URL + `/receptionist/cancel/`,
                    {
                        movie_id: movieId,
                        hall_id: hallId,
                        showtime_id: showtimeId,
                        seat_id: seatId
                    }

                );
                if (response.data.seat) {
                    this.selectedSeat = response.data.seat;

                }

            } catch (error) {
                console.error(error);
            }
        }


    }
};
</script>
