<template>
    <div class="login-view">
      <h2>Welcome Back</h2>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="form.email" type="email" id="email" required />
        </div>
  
        <div class="form-group">
          <label for="password">Password</label>
          <input v-model="form.password" type="password" id="password" required />
        </div>
  
        <button type="submit" class="btn">Log In</button>
      </form>
  
      <p class="alt-link">
        Need an account?
        <router-link to="/signup">Sign up here</router-link>
      </p>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { reactive } from 'vue'
  import { useRouter } from 'vue-router'
  
  const router = useRouter()
  
  const form = reactive({
    email: '',
    password: ''
  })
  
  function handleLogin() {
    // Fake login logic for now
    console.log('Logged in with:', form)
  
    // Redirect to dashboard
    router.push('/dashboard')
  }
  </script>
  
  <style scoped>
  .login-view {
    max-width: 400px;
    margin: 3rem auto;
    padding: 2rem;
    border: 1px solid #d1d5db;
    border-radius: 1rem;
    background: #fff;
  }
  
  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }
  
  input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #9ca3af;
    border-radius: 0.5rem;
  }
  
  .btn {
    width: 100%;
    margin-top: 1rem;
    padding: 0.75rem;
    background-color: #4f46e5;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
  }
  
  .btn:hover {
    background-color: #3730a3;
  }
  
  .alt-link {
    text-align: center;
    margin-top: 1rem;
  }
  </style>
  