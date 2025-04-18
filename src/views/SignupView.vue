<template>
    <div class="signup-view">
      <h2>Create Your Account</h2>
      <form @submit.prevent="handleSignup">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input v-model="form.name" type="text" id="name" required />
        </div>
  
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="form.email" type="email" id="email" required />
        </div>
  
        <div class="form-group">
          <label for="password">Password</label>
          <input v-model="form.password" type="password" id="password" required />
        </div>
  
        <button type="submit" class="btn">Sign Up</button>
      </form>
  
      <p class="alt-link">
        Already have an account?
        <router-link to="/login">Log in</router-link>
      </p>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { reactive } from 'vue'
  import { useRouter } from 'vue-router'
  
  const router = useRouter()
  
  const form = reactive({
    name: '',
    email: '',
    password: ''
  })
  
  function handleSignup() {
    // Fake signup logic for now
    console.log('Signed up with:', form)
  
    // Redirect to dashboard
    router.push('/dashboard')
  }
  </script>
  
  <style scoped>
  .signup-view {
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
  