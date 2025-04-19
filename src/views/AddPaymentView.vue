<template>
  <div class="add-payment-view">
    <div class="payment-header">
      <h1>Record New Payment</h1>
      <p class="subtitle">Add payment details for completed sessions</p>
    </div>

    <div class="payment-card">
      <form @submit.prevent="submitPayment" class="payment-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="session">Session</label>
            <select 
              v-model="form.session_id" 
              id="session"
              class="form-select"
              required
            >
              <option disabled value="">Select Session</option>
              <option 
                v-for="session in sessions" 
                :key="session.id" 
                :value="session.id"
              >
                {{ formatSessionDate(session.date) }} @ {{ session.time }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label for="amount">Amount ($)</label>
            <input 
              v-model.number="form.amount" 
              type="number" 
              id="amount"
              min="0" 
              step="0.01" 
              placeholder="0.00"
              class="form-input"
              required 
            />
          </div>

          <div class="form-group">
            <label for="method">Payment Method</label>
            <select 
              v-model="form.method" 
              id="method"
              class="form-select"
              required
            >
              <option disabled value="">Select Method</option>
              <option value="card">Credit/Debit Card</option>
              <option value="cash">Cash</option>
              <option value="paypal">PayPal</option>
              <option value="bank">Bank Transfer</option>
            </select>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-submit">
            <span>Record Payment</span>
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
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/authStore'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()

interface Session {
  id: number
  date: string
  time: string
}

const sessions = ref<Session[]>([])

const form = ref({
  session_id: '',
  amount: 0,
  method: ''
})

const successMessage = ref('')
const errorMessage = ref('')

function formatSessionDate(dateString: string) {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/sessions', {
      headers: { Authorization: `Bearer ${auth.token}` }
    })
    sessions.value = res.data
  } catch (err) {
    errorMessage.value = 'Failed to load available sessions'
    console.error('Session fetch error:', err)
  }
})

async function submitPayment() {
  try {
    await axios.post('http://localhost:8000/api/payments', form.value, {
      headers: { Authorization: `Bearer ${auth.token}` }
    })
    successMessage.value = 'Payment recorded successfully!'
    errorMessage.value = ''
    setTimeout(() => router.push('/payments'), 1500)
  } catch (err) {
    errorMessage.value = 'Error recording payment. Please try again.'
    successMessage.value = ''
    console.error(err)
  }
}
</script>

<style scoped>
.add-payment-view {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem 1.5rem;
}

.payment-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.payment-header h1 {
  font-size: 2rem;
  color: #f8fafc;
  margin-bottom: 0.75rem;
}

.subtitle {
  color: #94a3b8;
  font-size: 1.1rem;
}

.payment-card {
  background: #1e293b;
  border-radius: 1rem;
  padding: 2rem;
  border: 1px solid #334155;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 1.5rem;
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
.form-select:focus {
  outline: none;
  border-color: #38b6ff;
  box-shadow: 0 0 0 3px rgba(56, 182, 255, 0.2);
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 16px 12px;
}

.form-actions {
  margin-top: 1.5rem;
  text-align: right;
}

.btn-submit {
  background: linear-gradient(90deg, #38b6ff 0%, #4ade80 100%);
  color: #0f172a;
  border: none;
  padding: 0.875rem 2rem;
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

@media (max-width: 640px) {
  .payment-header h1 {
    font-size: 1.75rem;
  }
  
  .payment-card {
    padding: 1.5rem;
  }
  
  .form-grid {
    grid-template-columns: 1fr;
  }
  
  .btn-submit {
    width: 100%;
    justify-content: center;
  }
}
</style>