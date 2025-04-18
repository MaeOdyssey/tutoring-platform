<template>
    <button @click="logout" class="logout-btn">Logout</button>
  </template>
  
  <script setup lang="ts">
  import { useAuthStore } from '../stores/authStore'
  import { useRouter } from 'vue-router'
  
  const auth = useAuthStore()
  const router = useRouter()
  
  function logout() {
    auth.logout()
    router.push('/login')
  }
  </script>
  
  <style scoped>
  .logout-btn {
    background: #ef4444;
    color: white;
    padding: 0.6rem 1rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
  }
  .logout-btn:hover {
    background: #dc2626;
  }
  </style>
  