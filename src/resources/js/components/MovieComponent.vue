<template>
    <div id="movies" class="card mb-12">
        <div @click="selectMovie" class="card-body bgcover-2">
            <h5 class="card-title">{{ movie.title }}</h5>
            <p class="card-text">{{ movie.description }}</p>
        </div>
    </div>
</template>

<script>

export default {
    props: ['movie'],
    methods: {
        selectMovie() {
            this.$emit('childMovieSelected', this.movie)
        }
    }
}
</script>

<style>
.card {
    width: 18rem;
    margin: 1rem;
    display: inline-block;
}
</style>
