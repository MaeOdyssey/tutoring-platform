<template>
    <div class="dashboard-view">
      <h2 class="greeting">Welcome back!</h2>
      <p class="subtext">Here's what's waiting for you today:</p>
  
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
          <button class="btn">View Payments</button>
        </section>
      </div>
    </div>
  </template>
  
  <script lang="ts" setup>
  // You could pull name from user data later!
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
  