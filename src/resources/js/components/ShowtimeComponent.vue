<template>
    <div id="showtimes" class="showtime">
        <div>{{ showtime.date }}</div>
        <div class="showtime-time">{{ showtime.time }}</div>
        <button class="btn btn-yelloo" @click="selectShowtime">Select</button>
    </div>
</template>

<script>
export default {
    props: ['showtime'],
    methods: {
        selectShowtime() {
            this.$emit('childShowtimeSelected', this.showtime)
        }
    }
}
</script>

<style scoped>
.showtime {
    display: inline-block;
    padding: 10px;
    margin: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}

.showtime-time {
    font-weight: bold;
    font-size: 18px;
}
</style>
