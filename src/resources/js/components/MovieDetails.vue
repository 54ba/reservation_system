<template>
    <div class="movie-details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-12 bgcover-1">

                        <div class="card-body ">
                            <h5 class="card-title">{{ movie.title }}</h5>
                            <p class="card-text">{{ movie.description }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Director:</strong> {{ movie.director }}</li>
                            <li class="list-group-item"><strong>Starring:</strong> {{ movie.casting }}</li>
                            <li class="list-group-item" style="border-radius: 0;"><strong>Release Date:</strong> {{
                                movie.release_year }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['movie']
}
</script>

<style>
.card {
    width: 18rem;
    margin: 1rem;
    display: inline-block;
}
</style>
