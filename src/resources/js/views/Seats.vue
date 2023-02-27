<template>
    <div>
    <Seat
      v-for="seat in seats"
      :key="seat.id"
      :seat="seat"
      @childSeatReserved="reserveSeat"
      @childSeatCanceled="cancelSeat"

    />
    </div>
  </template>

  <script>
  import Seat from '../components/SeatComponent.vue'

  export default {
    components: {
    Seat
  },
    props: {
      seats: Array
    },
    methods: {
        reserveSeat(seat) {
        this.$emit("seatReserved", seat);
      },
      cancelSeat(seat) {
        this.$emit("seatCanceled", seat);
      }
    }
  };
  </script>
