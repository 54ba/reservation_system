<template>
    <li class="list-group-item">
        <h5 class="card-title">{{ hall.name }}</h5>
        <button class="btn btn-yelloo" @click="selectHall">Select</button>
    </li>
</template>

<script>
export default {
    props: ['hall'],
    methods: {
        selectHall() {
            this.$emit('childHallSelected', this.hall)
        },

    }
}
</script>

