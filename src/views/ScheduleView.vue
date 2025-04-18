<template>
    <div class="schedule-view">
      <h2>📅 Book a Tutoring Session</h2>
  
      <form @submit.prevent="bookSession" class="booking-form">
        <div class="form-group">
          <label for="date">Select a Date</label>
          <Datepicker v-model="selectedDate" :inline="true" />
        </div>
  
        <div class="form-group">
          <label for="time">Select a Time</label>
          <select v-model="selectedTime" required>
            <option disabled value="">Choose a time</option>
            <option v-for="time in timeSlots" :key="time">{{ time }}</option>
          </select>
        </div>
  
        <button class="btn" type="submit">Book Session</button>
      </form>
  
      <div v-if="confirmation" class="confirmation">
        🎉 Session booked for <strong>{{ selectedDate?.toLocaleDateString() }}</strong> at <strong>{{ selectedTime }}</strong>!
      </div>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { ref } from 'vue'
  import Datepicker from 'vue3-datepicker'
  
  const selectedDate = ref<Date | null>(null)
  const selectedTime = ref('')
  const confirmation = ref(false)
  
  const timeSlots = [
    '9:00 AM', '10:30 AM', '12:00 PM',
    '1:30 PM', '3:00 PM', '4:30 PM',
    '6:00 PM'
  ]
  
  function bookSession() {
    if (selectedDate.value && selectedTime.value) {
      console.log('Session booked:', selectedDate.value, selectedTime.value)
      confirmation.value = true
    }
  }
  </script>
  
  <style scoped>
  .schedule-view {
    max-width: 600px;
    margin: 3rem auto;
    text-align: center;
  }
  
  .booking-form {
    margin-top: 2rem;
  }
  
  .form-group {
    margin-bottom: 1.5rem;
    text-align: left;
  }
  
  label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
  }
  
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
  
  .confirmation {
    margin-top: 2rem;
    padding: 1rem;
    border: 2px solid #4ade80;
    background-color: #ecfdf5;
    border-radius: 1rem;
    font-weight: bold;
  }
  </style>
  