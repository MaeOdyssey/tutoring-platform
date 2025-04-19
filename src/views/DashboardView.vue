<template>
  <div class="dashboard-view">
    <div class="dashboard-header">
      <h1>Welcome back<span v-if="auth.user">, {{ auth.user.name }}</span>!</h1>
      <p class="subtitle">Here's what's happening today</p>
    </div>

    <div class="dashboard-content">
      <!-- Upcoming Sessions Section -->
      <section class="upcoming-sessions">
        <div class="section-header">
          <h2>Upcoming Sessions</h2>
          <router-link to="/schedule" class="view-all">View All</router-link>
        </div>

        <div v-if="sessions.length" class="sessions-list">
          <div v-for="session in sessions" :key="session.id" class="session-card">
            <div class="session-time">
              <span class="date">{{ formatDate(session.date) }}</span>
              <span class="time">{{ formatTime(session.date) }}</span>
            </div>
            <div class="session-status" :class="session.status.toLowerCase()">
              {{ session.status }}
            </div>
            <button class="join-btn">
              <i class="fas fa-video"></i> Join
            </button>
          </div>
        </div>

        <div v-else class="empty-state">
          <i class="fas fa-calendar-alt"></i>
          <p>No upcoming sessions scheduled</p>
          <router-link to="/schedule" class="btn-primary">
            <i class="fas fa-plus"></i> Schedule Session
          </router-link>
        </div>
      </section>

      <!-- Quick Actions Grid -->
      <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="actions-grid">
          <router-link to="/schedule" class="action-card">
            <div class="card-icon" style="background-color: rgba(56, 182, 255, 0.1);">
              <i class="fas fa-calendar-plus" style="color: #38b6ff;"></i>
            </div>
            <h3>Schedule Session</h3>
            <p>Book your next tutoring session</p>
          </router-link>

          <router-link to="/video" class="action-card">
            <div class="card-icon" style="background-color: rgba(74, 222, 128, 0.1);">
              <i class="fas fa-video" style="color: #4ade80;"></i>
            </div>
            <h3>Video Room</h3>
            <p>Connect with students</p>
          </router-link>

          <router-link to="/payments" class="action-card">
            <div class="card-icon" style="background-color: rgba(239, 68, 68, 0.1);">
              <i class="fas fa-credit-card" style="color: #ef4444;"></i>
            </div>
            <h3>Payments</h3>
            <p>View transactions</p>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/authStore'

const auth = useAuthStore()

interface Session {
  id: number
  date: string
  status: string
}

const sessions = ref<Session[]>([])

const formatDate = (dateString: string) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    weekday: 'short',
    month: 'short',
    day: 'numeric'
  })
}

const formatTime = (dateString: string) => {
  return new Date(dateString).toLocaleTimeString('en-US', {
    hour: '2-digit',
    minute: '2-digit'
  })
}

onMounted(async () => {
  if (auth.token && !auth.user) {
    await auth.fetchUser()
  }

  try {
    const res = await axios.get('http://localhost:8000/api/sessions', {
      headers: { Authorization: `Bearer ${auth.token}` }
    })

    const now = new Date()
    sessions.value = (res.data as Session[]).filter((session) => {
      return new Date(session.date) >= now
    }).slice(0, 3) // Show only next 3 sessions

  } catch (err) {
    console.error('Failed to fetch sessions:', err)
  }
})
</script>

<style scoped>
.dashboard-view {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1.5rem;
  background-color: #0f172a; /* Dark blue-gray background */
  min-height: 100vh;
  color: #e2e8f0; /* Light gray text for contrast */
}

.dashboard-header {
  margin-bottom: 2.5rem;
}

.dashboard-header h1 {
  font-size: 2.2rem;
  color: #f8fafc; /* Nearly white for maximum contrast */
  margin-bottom: 0.5rem;
  font-weight: 600;
}

.subtitle {
  color: #94a3b8; /* Lighter gray for secondary text */
  font-size: 1.1rem;
}

/* Upcoming Sessions */
.upcoming-sessions {
  background: #1e293b; /* Darker card background */
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 2rem;
  border: 1px solid #334155; /* Subtle border */
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.section-header h2 {
  font-size: 1.5rem;
  color: #f8fafc; /* High contrast */
}

.view-all {
  color: #38b6ff; /* Bright blue for links */
  font-size: 0.9rem;
  font-weight: 500;
  text-decoration: none;
}

.view-all:hover {
  text-decoration: underline;
}

.sessions-list {
  display: grid;
  gap: 1rem;
}

.session-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  border-radius: 8px;
  background-color: #1e293b;
  border: 1px solid #334155;
  transition: all 0.2s ease;
}

.session-card:hover {
  background-color: #334155;
}

.session-time {
  display: flex;
  flex-direction: column;
}

.session-time .date {
  font-weight: 600;
  color: #f8fafc;
}

.session-time .time {
  color: #94a3b8;
  font-size: 0.9rem;
}

.session-status {
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 500;
}

.session-status.confirmed {
  background-color: rgba(74, 222, 128, 0.1);
  color: #4ade80;
}

.session-status.pending {
  background-color: rgba(234, 179, 8, 0.1);
  color: #eab308;
}

.join-btn {
  background-color: #38b6ff;
  color: #0f172a; /* Dark text on light button */
  border: none;
  border-radius: 6px;
  padding: 0.5rem 1rem;
  font-size: 0.9rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s ease;
  font-weight: 500;
}

.join-btn:hover {
  background-color: #0ea5e9;
}

.empty-state {
  text-align: center;
  padding: 2rem;
  background-color: #1e293b;
  border-radius: 8px;
  border: 1px dashed #334155;
}

.empty-state i {
  font-size: 2rem;
  color: #38b6ff;
  margin-bottom: 1rem;
}

.empty-state p {
  color: #94a3b8;
  margin-bottom: 1.5rem;
}

/* Quick Actions */
.quick-actions {
  margin-bottom: 2rem;
}

.quick-actions h2 {
  font-size: 1.5rem;
  color: #f8fafc;
  margin-bottom: 1.5rem;
}

.actions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.action-card {
  background: #1e293b;
  border-radius: 12px;
  padding: 1.5rem;
  text-decoration: none;
  transition: all 0.2s ease;
  border: 1px solid #334155;
}

.action-card:hover {
  transform: translateY(-4px);
  background-color: #334155;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
}

.card-icon i {
  font-size: 1.25rem;
}

.action-card h3 {
  color: #f8fafc;
  margin-bottom: 0.5rem;
  font-size: 1.1rem;
}

.action-card p {
  color: #94a3b8;
  font-size: 0.9rem;
}

/* Buttons */
.btn-primary {
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

.btn-primary:hover {
  background-color: #0ea5e9;
}

@media (max-width: 768px) {
  .dashboard-header h1 {
    font-size: 1.8rem;
  }
  
  .actions-grid {
    grid-template-columns: 1fr;
  }
}
</style>