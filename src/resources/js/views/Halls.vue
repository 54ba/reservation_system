<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-12 bgcover-1">

                        <div class="card-body ">
                            <h5 class="card-title">Halls</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <Hall v-for="hall in halls" :key="hall.id" :hall="hall"
                                @childHallSelected="handleHallSelection" />

                        </ul>
                        <div v-if="selectedHall">
                            <Showtimes :showtimes="showtimes" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
import Hall from '../components/HallComponent.vue'
import Showtimes from '../views/Showtimes.vue';

export default {
    components: {
        Hall,
        Showtimes,
    },
    data() {
        return {
            // Hold the state
            selectedHall: null,
            showtimes: []
        };
    },
    name: "Halls",
    props: ['halls'],
    methods: {
        // Method to update the state when a hall is selected
        handleHallSelection(hall) {
            this.selectedHall = hall;
            this.getShowtimes(hall.movie_id, hall.id)

        },
        // Method to make the API call to get the showtimes for a movie and hall
        async getShowtimes(movieId, hallId) {
            try {
                const response = await axios.get(
                    process.env.MIX_API_URL + `/receptionist/showtimes/${movieId}/${hallId}`
                );
                this.showtimes = response.data.showtimes;
                return response.data.showtimes;
            } catch (error) {
                console.error(error);
            }
        },


    },

}

</script>
