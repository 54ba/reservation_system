<script setup>

import { RouterLink } from "vue-router";
</script>


<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Movie Booking</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" to="#">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="#movies">Movies</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="#halls">Halls</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="#showtimes">Showtimes</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="#seats">seats</router-link>
            </li>
          </ul>
        </div>
      </nav>

    </template>
