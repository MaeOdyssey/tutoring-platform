<template>
    <div class="teacher-login-view">
      <h2>Welcome, Teacher 👩‍🏫</h2>
      <AuthenticatorWidget mode="teacher" />
    </div>
  </template>
  
  <script setup lang="ts">
  import AuthenticatorWidget from '../components/AuthenticatorWidget.vue'
  </script>
  
  <style scoped>
  .teacher-login-view {
    max-width: 500px;
    margin: 4rem auto;
    padding: 2rem;
    background: #f9fafb;
    border-radius: 1rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    text-align: center;
  }
  </style>
  