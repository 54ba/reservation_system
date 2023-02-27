<template>
    <div id="seats" class="card m-3" :class="{ 'bg-success': seat.status == 'available' ,'bg-danger': seat.status == 'reserved'  }">
      <div class="card-body">
        <h5 class="card-title">Seat {{ seat.seat_number }}</h5>

        <template v-if="seat.status == 'available'">
                <button  class="btn btn-primary" @click="reserveSeat">reserve</button>
         </template>
        <template v-else>
                <button  class="btn btn-danger" @click="cancelSeat">cancel</button>
        </template>
      </div>
    </div>
  </template>

  <script>
  {

  }
  export default {
    props: ['seat'],
    methods: {
      reserveSeat() {
        if (this.seat.status == "available") {
          this.$emit('childSeatReserved', this.seat)
        }
      },
      cancelSeat() {
        if (this.seat.status != "available") {
            if (confirm("Are you sure you want to cancel this reservation?")) {

                this.$emit('childSeatCanceled', this.seat)
            }
        }
      }
    }

  }
  </script>

  <style>
  .bg-success {
    background-color: green;
  }

  .bg-danger {
    background-color: red;
  }
  </style>
