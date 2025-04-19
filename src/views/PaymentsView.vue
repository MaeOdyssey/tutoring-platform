<template>
  <div class="payments-view">
    <div class="payments-header">
      <h1>Payment History</h1>
      <router-link to="/payments/new" class="btn-add">
        <i class="fas fa-plus"></i> Add Payment
      </router-link>
    </div>

    <div v-if="payments.length" class="payments-table-container">
      <table class="payments-table">
        <thead>
          <tr>
            <th>Amount</th>
            <th>Method</th>
            <th>Status</th>
            <th>Session Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="payment in payments" :key="payment.id">
            <td>${{ Number(payment.amount).toFixed(2) }}</td>
            <td>{{ payment.method }}</td>
            <td>
              <span class="status-badge" :class="payment.status.toLowerCase()">
                {{ payment.status }}
              </span>
            </td>
            <td>{{ formatDate(payment.session_date) }}</td>
            <td>
              <button class="action-btn">
                <i class="fas fa-receipt"></i> Receipt
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="empty-state">
      <i class="fas fa-credit-card"></i>
      <h3>No Payment History</h3>
      <p>You don't have any recorded payments yet</p>
      <router-link to="/payments/new" class="btn-add">
        <i class="fas fa-plus"></i> Add Payment
      </router-link>
    </div>
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
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}
</script>

<style scoped>
.payments-view {
  max-width: 1000px;
  margin: 2rem auto;
  padding: 0 1.5rem;
}

.payments-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.payments-header h1 {
  font-size: 1.8rem;
  color: #f8fafc;
}

.payments-table-container {
  background: #1e293b;
  border-radius: 12px;
  padding: 1.5rem;
  border: 1px solid #334155;
}

.payments-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.payments-table th {
  background-color: #1e293b;
  color: #94a3b8;
  font-weight: 500;
  text-align: left;
  padding: 1rem;
  border-bottom: 1px solid #334155;
}

.payments-table td {
  padding: 1rem;
  border-bottom: 1px solid #334155;
  color: #e2e8f0;
}

.payments-table tr:last-child td {
  border-bottom: none;
}

.payments-table tr:hover td {
  background-color: rgba(255, 255, 255, 0.03);
}

.status-badge {
  padding: 0.35rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 500;
}

.status-badge.completed,
.status-badge.paid,
.status-badge.success {
  background-color: rgba(74, 222, 128, 0.1);
  color: #4ade80;
}

.status-badge.pending {
  background-color: rgba(234, 179, 8, 0.1);
  color: #eab308;
}

.status-badge.failed,
.status-badge.declined {
  background-color: rgba(239, 68, 68, 0.1);
  color: #ef4444;
}

.action-btn {
  background: transparent;
  color: #38b6ff;
  border: 1px solid #38b6ff;
  border-radius: 6px;
  padding: 0.5rem 1rem;
  font-size: 0.85rem;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s ease;
}

.action-btn:hover {
  background: rgba(56, 182, 255, 0.1);
}

.btn-add {
  background-color: #38b6ff;
  color: #0f172a;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s ease;
}

.btn-add:hover {
  background-color: #0ea5e9;
}

.empty-state {
  text-align: center;
  padding: 3rem;
  background-color: #1e293b;
  border-radius: 12px;
  border: 1px dashed #334155;
}

.empty-state i {
  font-size: 2.5rem;
  color: #38b6ff;
  margin-bottom: 1rem;
}

.empty-state h3 {
  color: #f8fafc;
  margin-bottom: 0.5rem;
}

.empty-state p {
  color: #94a3b8;
  margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
  .payments-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
  
  .payments-table th, 
  .payments-table td {
    padding: 0.75rem 0.5rem;
    font-size: 0.9rem;
  }
  
  .action-btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.8rem;
  }
}
</style>