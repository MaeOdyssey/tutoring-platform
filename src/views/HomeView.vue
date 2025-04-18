<template>
    <div class="home-view">
      <Navbar />
  
      <section class="welcome-section">
        <h1>Welcome to LearnTogether 🎓</h1>
        <p>A safe and supportive tutoring platform built for healing and connection.</p>
  
        <div class="action-links">
          <router-link to="/login" class="btn">Log In</router-link>
          <router-link to="/signup" class="btn">Sign Up</router-link>
        </div>
      </section>
    </div>
  </template>
  
  <script lang="ts" setup>
  import Navbar from '../components/Navbar.vue'
  </script>
  
  <style scoped>
  .home-view {
    padding: 2rem;
    text-align: center;
  }
  
  .welcome-section {
    margin-top: 3rem;
  }
  
  .btn {
    display: inline-block;
    margin: 1rem;
    padding: 0.75rem 1.5rem;
    background-color: #4f46e5;
    color: white;
    text-decoration: none;
    border-radius: 0.5rem;
    font-weight: bold;
  }
  
  .btn:hover {
    background-color: #3730a3;
  }
  </style>
  