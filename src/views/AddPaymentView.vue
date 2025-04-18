<template>
    <div class="add-payment-view">
      <h2>➕ Add New Payment</h2>
  
      <form @submit.prevent="submitPayment" class="payment-form">
        <div class="form-group">
          <label for="user">User</label>
          <select v-model="form.user_id" required>
            <option disabled value="">Select User</option>
            <option v-for="user in users" :key="user.id" :value="user.id">
              {{ user.name }} ({{ user.email }})
            </option>
          </select>
        </div>
  
        <div class="form-group">
          <label for="session">Session</label>
          <select v-model="form.session_id" required>
            <option disabled value="">Select Session</option>
            <option v-for="session in sessions" :key="session.id" :value="session.id">
              {{ new Date(session.date).toLocaleDateString() }} @ {{ session.time }}
            </option>
          </select>
        </div>
  
        <div class="form-group">
          <label for="amount">Amount</label>
          <input v-model.number="form.amount" type="number" min="0" step="0.01" required />
        </div>
  
        <div class="form-group">
          <label for="method">Payment Method</label>
          <select v-model="form.method" required>
            <option disabled value="">Select Method</option>
            <option>card</option>
            <option>cash</option>
            <option>paypal</option>
          </select>
        </div>
  
        <button class="btn" type="submit">Submit Payment</button>
      </form>
  
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  import { useAuthStore } from '../stores/authStore'
  import { useRouter } from 'vue-router'
  
  const auth = useAuthStore()
  const router = useRouter()
  
  interface User {
  id: number
  name: string
  email: string
}

interface Session {
  id: number
  date: string
  time: string
}

const users = ref<User[]>([])
const sessions = ref<Session[]>([])

  
  const form = ref({
    user_id: '',
    session_id: '',
    amount: 0,
    method: ''
  })
  
  const successMessage = ref('')
  const errorMessage = ref('')
  
  onMounted(async () => {
    try {
      const userRes = await axios.get('http://localhost:8000/api/users', {
        headers: { Authorization: `Bearer ${auth.token}` }
      })
      users.value = userRes.data
  
      const sessionRes = await axios.get('http://localhost:8000/api/sessions', {
        headers: { Authorization: `Bearer ${auth.token}` }
      })
      sessions.value = sessionRes.data
    } catch (err) {
      errorMessage.value = 'Failed to load users or sessions'
      console.error(err)
    }
  })
  
  async function submitPayment() {
    try {
      await axios.post('http://localhost:8000/api/payments', form.value, {
        headers: { Authorization: `Bearer ${auth.token}` }
      })
      successMessage.value = 'Payment submitted successfully!'
      errorMessage.value = ''
      router.push('/payments')
    } catch (err) {
      errorMessage.value = 'Something went wrong submitting the payment.'
      successMessage.value = ''
      console.error(err)
    }
  }
  </script>
  
  <style scoped>
  .add-payment-view {
    max-width: 600px;
    margin: 3rem auto;
    padding: 1.5rem;
    text-align: left;
  }
  
  .form-group {
    margin-bottom: 1.5rem;
  }
  
  label {
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
  }
  
  input,
  select {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #9ca3af;
    border-radius: 0.5rem;
  }
  
  .btn {
    margin-top: 1rem;
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
  