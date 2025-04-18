<template>
    <nav class="navbar">
      <div class="nav-logo">
        <router-link to="/" class="logo-link">🧠 LearnTogether</router-link>
      </div>
  
      <div class="nav-links">
        <router-link to="/login" class="nav-link">Log In</router-link>
        <router-link to="/signup" class="nav-link">Sign Up</router-link>
        <LogoutButton />

      </div>
    </nav>
  </template>
  
  <script lang="ts" setup>
import LogoutButton from '../components/LogoutButton.vue'

</script>
  
  <style scoped>
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #f3f4f6;
    border-bottom: 1px solid #d1d5db;
  }
  
  .logo-link {
    font-weight: bold;
    font-size: 1.25rem;
    color: #111827;
    text-decoration: none;
  }
  
  .nav-links {
    display: flex;
    gap: 1rem;
  }
  
  .nav-link {
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
  }
  
  .nav-link:hover {
    text-decoration: underline;
  }
  </style>
  