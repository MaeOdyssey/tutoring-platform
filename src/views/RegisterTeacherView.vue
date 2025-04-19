<template>
    <div class="register-teacher-view">
      <div class="register-container">
        <div class="register-header">
          <h1>Join Our <span class="highlight">Educator Community</span></h1>
          <p>Complete your profile to start teaching on LearnTogether</p>
        </div>
  
        <div class="register-card">
          <form @submit.prevent="register" class="teacher-form">
            <div class="form-grid">
              <div class="form-group" v-for="(label, field) in fields" :key="field">
                <label :for="field">{{ label }}</label>
                <input
                  v-if="field !== 'bio' && field !== 'availability'"
                  v-model="form[field]"
                  :type="field === 'password' ? 'password' : 'text'"
                  :id="field"
                  required
                  class="form-input"
                />
                <textarea
                  v-else-if="field === 'bio'"
                  v-model="form.bio"
                  id="bio"
                  rows="4"
                  class="form-textarea"
                  placeholder="Share your teaching philosophy, experience, and credentials..."
                ></textarea>
                <select
                  v-else-if="field === 'availability'"
                  v-model="form.availability"
                  id="availability"
                  class="form-select"
                  required
                >
                  <option value="" disabled selected>Select availability</option>
                  <option value="Full-time">Full-time</option>
                  <option value="Part-time">Part-time</option>
                  <option value="Weekends">Weekends only</option>
                  <option value="Evenings">Evenings only</option>
                </select>
              </div>
            </div>
  
            <div class="form-actions">
              <button type="submit" class="btn-submit">
                <span>Complete Registration</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
              </button>
            </div>
          </form>
  
          <div v-if="successMessage" class="message success">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
              <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ successMessage }}</span>
          </div>
  
          <div v-if="errorMessage" class="message error">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ errorMessage }}</span>
          </div>
        </div>
      </div>
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
  
  const fields = {
    name: 'Full Name',
    email: 'Email Address',
    password: 'Create Password',
    specialty: 'Teaching Specialty',
    availability: 'Availability',
    bio: 'Professional Bio'
  }
  
  const successMessage = ref('')
  const errorMessage = ref('')
  
  async function register() {
    try {
      const res = await axios.post('http://localhost:8000/api/teacher', form.value)
      const token = res.data.token
      auth.setToken(token)
  
      successMessage.value = 'Registration successful! Welcome to our educator community.'
      errorMessage.value = ''
  
      setTimeout(() => router.push('/teacher/dashboard'), 1500)
    } catch (err) {
      console.error(err)
      errorMessage.value = 'Registration failed. Please check your information and try again.'
      successMessage.value = ''
    }
  }
  </script>
  
  <style scoped>
  .register-teacher-view {
    background-color: #0f172a;
    min-height: 100vh;
    padding: 2rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .register-container {
    max-width: 900px;
    width: 100%;
  }
  
  .register-header {
    text-align: center;
    margin-bottom: 3rem;
  }
  
  .register-header h1 {
    font-size: 2.5rem;
    color: #f8fafc;
    margin-bottom: 1rem;
    line-height: 1.2;
  }
  
  .register-header p {
    color: #94a3b8;
    font-size: 1.1rem;
  }
  
  .highlight {
    background: linear-gradient(90deg, #7dd3fc 0%, #38b6ff 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  
  .register-card {
    background: #1e293b;
    border-radius: 1rem;
    padding: 2.5rem;
    border: 1px solid #334155;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }
  
  .teacher-form {
    margin-top: 1rem;
  }
  
  .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  label {
    display: block;
    color: #e2e8f0;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }
  
  .form-input,
  .form-textarea,
  .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: #1e293b;
    border: 1px solid #334155;
    border-radius: 0.5rem;
    color: #f8fafc;
    font-size: 1rem;
    transition: all 0.2s ease;
  }
  
  .form-input:focus,
  .form-textarea:focus,
  .form-select:focus {
    outline: none;
    border-color: #38b6ff;
    box-shadow: 0 0 0 3px rgba(56, 182, 255, 0.2);
  }
  
  .form-textarea {
    min-height: 120px;
    resize: vertical;
  }
  
  .form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
  }
  
  .form-actions {
    margin-top: 2rem;
    text-align: center;
  }
  
  .btn-submit {
    background: linear-gradient(90deg, #38b6ff 0%, #4ade80 100%);
    color: #0f172a;
    border: none;
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(56, 182, 255, 0.25);
  }
  
  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(56, 182, 255, 0.35);
  }
  
  .message {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-top: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
  }
  
  .message.success {
    background-color: rgba(74, 222, 128, 0.1);
    color: #4ade80;
    border: 1px solid rgba(74, 222, 128, 0.2);
  }
  
  .message.error {
    background-color: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.2);
  }
  
  @media (max-width: 768px) {
    .register-header h1 {
      font-size: 2rem;
    }
    
    .register-card {
      padding: 1.5rem;
    }
    
    .form-grid {
      grid-template-columns: 1fr;
    }
  }
  </style>