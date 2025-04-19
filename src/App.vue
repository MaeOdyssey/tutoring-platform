<template>
  <div id="app">
    <Navbar />
    <router-link to="/register-teacher">Become a Teacher</router-link>

    <router-view />
  </div>
</template>

<script lang="ts" setup>
import Navbar from './components/Navbar.vue'

</script>

<style>
/* Optional global styles */
body {
  margin: 0;
  font-family: 'Inter', sans-serif;
  background-color: #fff;
  color: #111827;
}
</style>
