import { createRouter, createWebHistory } from "vue-router";
import Halls from '../views/Halls.vue'
import Movies from '../views/Movies.vue'
import Seats from '../views/Seats.vue'
import Showtimes from '../views/Showtimes.vue'
import Confirm from '../views/Confirm.vue'
import Home from '../views/Home.vue'


const router = createRouter({
    history: createWebHistory("/"),

    routes: [{
            path: "/",
            name: "Home",
            component: Home,
        },
        {
            path: '/movies',
            name: 'Movies',
            component: Movies
        },
        {
            path: '/halls/:movieId',
            name: 'Halls',
            component: Halls,
            props: true

        },
        {
            path: '/showtimes/:movieId/:hallId/',
            name: 'Showtimes',
            component: Showtimes,
            props: true
        },
        {
            path: '/seats/:movieId/:hallId/:showtimeId',
            name: 'Seats',
            component: Seats,
            props: true
        },

        {
            path: '/confirm/:movieId/:hallId/:showtimeId/:seats',
            name: 'Confirm',
            component: Confirm,
            props: true
        }
    ]
})

export default router;

// const bus = new Vue()
// router.beforeEach((to, from, next) => {
//     if (to.name === 'Confirm') {
//         bus.$on('selected-hall', (hall) => {
//             axios.get(`/receptionist/halls/${hall.movieId}`)
//                 .then(response => {
//                     console.log(`Selected Hall: ${response.data}`)
//                 })
//                 .catch(error => {
//                     console.error(error)
//                 })
//         })
//         bus.$on('cancelReservation', () => {
//             axios.delete(`/receptionist/cancel/${reservationId}`)
//                 .then(response => {
//                     console.log(`Reservation cancelled: ${response.data}`)
//                 })
//                 .catch(error => {
//                     console.error(error)
//                 })
//         })
//         bus.$on('confirmReservation', () => {
//             axios.post(`/receptionist/reserve`, {
//                     movieId: movieId,
//                     hallId: hallId,
//                     time: time,
//                     seats: seats
//                 })
//                 .then(response => {
//                     console.log(`Reservation confirmed: ${response.data}`)
//                 })
//                 .catch(error => {
//                     console.error(error)
//                 })
//         })
//     }
//     next()
// })
