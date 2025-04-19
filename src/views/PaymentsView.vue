<template>
  <div class="payments-view">
    <h2>💳 Your Payment History</h2>
    <router-link to="/payments/new" class="btn-add">
      ➕ Add Payment
    </router-link>

    <section v-if="payments.length">
      <table>
        <thead>
          <tr>
            <th>Amount</th>
            <th>Method</th>
            <th>Status</th>
            <th>Session Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="payment in payments" :key="payment.id">
            <td>${{ Number(payment.amount).toFixed(2) }}</td>
            <td>{{ payment.method }}</td>
            <td>{{ payment.status }}</td>
            <td>{{ formatDate(payment.session_date) }}</td>
          </tr>
        </tbody>
      </table>
    </section>

    <p v-else class="no-payments">You don’t have any recorded payments yet.</p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/authStore'

const auth = useAuthStore()
interface Payment {
  id: number
  amount: number
  method: string
  status: string
  session_date: string
}

const payments = ref<Payment[]>([])


onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/payments', {
      headers: {
        Authorization: `Bearer ${auth.token}`
      }
    })
    payments.value = res.data
  } catch (err) {
    console.error('Error fetching payments:', err)
  }
})

function formatDate(dateString: string) {
  return new Date(dateString).toLocaleDateString()
}
</script>

<style scoped>
.payments-view {
  max-width: 800px;
  margin: 3rem auto;
  padding: 1.5rem;
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 2rem;
}

th, td {
  padding: 0.75rem;
  border: 1px solid #ddd;
  text-align: center;
}

th {
  background-color: #4f46e5;
  color: white;
}

.no-payments {
  margin-top: 2rem;
  font-weight: bold;
  color: #6b7280;
}
.btn-add {
  display: inline-block;
  margin-bottom: 1.5rem;
  padding: 0.6rem 1.2rem;
  background-color: #10b981; /* emerald green */
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 0.5rem;
  text-decoration: none;
  cursor: pointer;
}

.btn-add:hover {
  background-color: #059669;
}

</style>
