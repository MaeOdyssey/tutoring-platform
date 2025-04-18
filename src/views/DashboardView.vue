<template>
    <div class="dashboard-view">
      <h2 class="greeting"> Welcome back<span v-if="auth.user">, {{ auth.user.name }}</span>!
</h2>

      <p class="subtext">Here's what's waiting for you today:</p>
      <section v-if="sessions.length" class="dashboard-card card-upcoming">
        <h3>📆 Upcoming Sessions</h3>
        <ul>
          <li v-for="session in sessions" :key="session.id">
            {{ new Date(session.date).toLocaleString() }}
          </li>
        </ul>
      </section>
      <p v-else class="subtext">You have no upcoming sessions yet.</p>

  
      <div class="dashboard-grid">
        <section class="dashboard-card card-schedule">
          <h3>📅 Schedule a Session</h3>
          <p>Book your next tutoring session easily.</p>
          <router-link to="/schedule" class="btn">Open Calendar</router-link>
        </section>
  
        <section class="dashboard-card card-video">
          <h3>📹 Join Live Video</h3>
          <p>Connect with students face-to-face.</p>
          <router-link to="/video" class="btn">Join Room</router-link>
        </section>
  
        <section class="dashboard-card card-payments">
          <h3>💳 Payments</h3>
          <p>Review payment history and plans.</p>
          <router-link to="/payments" class="btn">View Payments</router-link>
        </section>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted, watchEffect } from 'vue'
  import axios from 'axios'
  import { useAuthStore } from '../stores/authStore'
  
  const auth = useAuthStore()
  
  interface Session {
    id: number
    date: string
    time: string
    status: string
  }
  
  const sessions = ref<Session[]>([])
  
  onMounted(async () => {
    if (auth.token && !auth.user) {
      await auth.fetchUser()
    }
  
    try {
      const res = await axios.get('http://localhost:8000/api/sessions', {
        headers: {
          Authorization: `Bearer ${auth.token}`
        }
      })
  
      const now = new Date()
      sessions.value = (res.data as Session[]).filter((session) => {
        return new Date(session.date) >= now
      })
  
    } catch (err) {
      console.error('Failed to fetch sessions:', err)
    }
  })
  
  // 🧠 DEBUG: Force reactivity
  watchEffect(() => {
    console.log('auth.user updated:', auth.user)
  })
  </script>
  
  
  
  
  <style scoped>
  .dashboard-view {
    padding: 2rem;
    text-align: center;
  }
  
  .greeting {
    font-size: 2rem;
    font-weight: bold;
  }
  
  .subtext {
    color: #6b7280;
    margin-bottom: 2rem;
  }
  
  .dashboard-grid {
    display: grid;
    gap: 2rem;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  }
  
  .dashboard-card {
    padding: 1.5rem;
    border-radius: 1rem;
    color: #111827;
    background: #f9fafb;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s;
  }
  
  .dashboard-card:hover {
    transform: translateY(-3px);
  }
  
    .card-upcoming {
    border-top: 4px solid #a78bfa; /* purple */
    margin-bottom: 2rem;
    padding: 1.5rem;
  }
  ul {
    list-style: none;
    padding: 0;
  }
  li {
    margin: 0.5rem 0;
    font-weight: 500;
  }

  .card-schedule {
    border-top: 4px solid #4ade80; /* green */
  }
  
  .card-video {
    border-top: 4px solid #60a5fa; /* blue */
  }
  
  .card-payments {
    border-top: 4px solid #facc15; /* yellow */
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
    display: inline-block;
    text-decoration: none;
  }
  
  .btn:hover {
    background-color: #3730a3;
  }
  </style>
  