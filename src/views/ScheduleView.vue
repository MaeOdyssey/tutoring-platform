<template>
    <div class="schedule-view">
      <h2>📅 Book a Tutoring Session</h2>
  
      <form @submit.prevent="bookSession" class="booking-form">
        <p v-if="errorMessage" class="error-message">⚠️ {{ errorMessage }}</p>

        <div class="form-group">
          <label for="date">Select a Date</label>
          <Datepicker
            v-model="selectedDate"
            :inline="true"
            :min-date="today"
          />
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
  import axios from 'axios'
  import { useRouter } from 'vue-router'
  import { useAuthStore } from '../stores/authStore'

  const router = useRouter()
  const auth = useAuthStore()

  const today = new Date()
  today.setHours(0, 0, 0, 0) // Set to midnight to avoid timezone weirdness

  const selectedDate = ref<Date | undefined>(undefined)
  const selectedTime = ref('')
  const confirmation = ref(false)
  const errorMessage = ref('')

  const timeSlots = [
    '9:00 AM', '10:30 AM', '12:00 PM',
    '1:30 PM', '3:00 PM', '4:30 PM',
    '6:00 PM'
  ]
  
  function convertTo24Hour(timeStr: string): string {
  const [time, modifier] = timeStr.split(' ')
  let [hours, minutes] = time.split(':').map(Number)

  if (modifier === 'PM' && hours < 12) hours += 12
  if (modifier === 'AM' && hours === 12) hours = 0

  return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`
}

  async function bookSession() {
    errorMessage.value = '' // Clear old errors

    if (selectedDate.value && selectedTime.value) {
      // ✨ Convert to full datetime for selected session
      const sessionDateTime = new Date(
        `${selectedDate.value.toISOString().split('T')[0]}T${convertTo24Hour(selectedTime.value)}:00`
      )

      const now = new Date()

      // ✋ Check if selected datetime is in the past
      if (sessionDateTime <= now) {
        errorMessage.value = 'You can’t book a session in the past — choose a future time!'
        return
      }

      try {
        await axios.post('http://localhost:8000/api/sessions', {
          date: selectedDate.value.toISOString().split('T')[0],
          time: selectedTime.value,
        }, {
          headers: {
            Authorization: `Bearer ${auth.token}`
          }
        })

        confirmation.value = true
        errorMessage.value = ''

        setTimeout(() => {
          router.push('/dashboard')
        }, 1000)
      } catch (error) {
        console.error('Error booking session:', error)
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          errorMessage.value = 'Something went wrong: invalid session data.'
        } else {
          errorMessage.value = 'Something went wrong while booking. Please try again.'
        }
      }
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
  .error-message {
  margin-top: 1rem;
  color: #ef4444; /* red-500 */
  font-weight: 600;
  background-color: #fef2f2; /* red-50 */
  border: 1px solid #fecaca;
  padding: 0.75rem;
  border-radius: 0.5rem;
}

  </style>
  