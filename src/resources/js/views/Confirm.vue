<template>
    <div>
      <div class="d-flex justify-content-center align-items-center my-5">
        <h2 class="text-center">Confirm Your Reservation</h2>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-body">
                <p class="card-text">Movie: {{ movie }}</p>
                <p class="card-text">Hall: {{ hall }}</p>
                <p class="card-text">Time: {{ showtime }}</p>
                <p class="card-text">Seats: {{ seats.join(", ") }}</p>
              </div>
              <div class="card-footer">
                <button class="btn btn-danger" @click="cancelReservation">Cancel</button>
                <button class="btn btn-success" @click="confirmReservation">Confirm</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: ["movie", "hall", "showtime", "seats"],
    methods: {
      cancelReservation() {
        this.$emit("cancelReservation");
      },
      confirmReservation() {
        this.$emit("confirmReservation");
      }
    }
  };
  </script>



