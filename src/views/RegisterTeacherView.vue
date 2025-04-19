<template>
    <div class="register-teacher-view">
      <h2>🧑‍🏫 Register as a Teacher</h2>
  
      <form @submit.prevent="register" class="form">
        <div class="form-group">
          <label>Name</label>
          <input v-model="form.name" type="text" required />
        </div>
  
        <div class="form-group">
          <label>Email</label>
          <input v-model="form.email" type="email" required />
        </div>
  
        <div class="form-group">
          <label>Password</label>
          <input v-model="form.password" type="password" required />
        </div>
  
        <div class="form-group">
          <label>Bio</label>
          <textarea v-model="form.bio" rows="3" placeholder="Tell us about your teaching journey..."></textarea>
        </div>
  
        <div class="form-group">
          <label>Specialty</label>
          <input v-model="form.specialty" type="text" />
        </div>
  
        <div class="form-group">
          <label>Availability</label>
          <input v-model="form.availability" type="text" />
        </div>
  
        <button class="btn" type="submit">Register Teacher</button>
      </form>
  
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  import axios from 'axios'
  import { useRouter } from 'vue-router'
  import { useAuthStore } from '../stores/authStore'
  
  const router = useRouter()
  const auth = useAuthStore()
  
  const form = ref({
    name: '',
    email: '',
    password: '',
    bio: '',
    specialty: '',
    availability: ''
  })
  
  const successMessage = ref('')
  const errorMessage = ref('')
  
  async function register() {
    try {
      const res = await axios.post('http://localhost:8000/api/teacher', form.value)
      
      // Save token from response
      const token = res.data.token
      auth.setToken(token)
  
      // You might want to fetch teacher data here if needed
      successMessage.value = '🎉 Teacher registered successfully!'
      errorMessage.value = ''
  
      // Redirect to dashboard after short delay
      setTimeout(() => router.push('/teacher/dashboard'), 1500)
    } catch (err) {
      console.error(err)
      errorMessage.value = '❌ Registration failed. Please check your input and try again.'
      successMessage.value = ''
    }
  }
  </script>
  
  <style scoped>
  .register-teacher-view {
    max-width: 600px;
    margin: 3rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  
  .form-group {
    margin-bottom: 1.25rem;
  }
  
  label {
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
  }
  
  input, textarea {
    width: 100%;
    padding: 0.6rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
  }
  
  .btn {
    padding: 0.75rem 1.5rem;
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
  
  .success-message {
    color: #10b981;
    font-weight: bold;
    margin-top: 1rem;
  }
  
  .error-message {
    color: #ef4444;
    font-weight: bold;
    margin-top: 1rem;
  }
  </style>
  