<template>
    <div class="teacher-dashboard">
      <h2>👩‍🏫 Welcome, {{ teacher?.name }}</h2>
  
      <section class="courses-section" v-if="courses.length">
        <h3>📚 Your Courses</h3>
        <ul>
          <li v-for="course in courses" :key="course.id">
            <strong>{{ course.title }}</strong> - ${{ course.fee }} <br />
            {{ course.description }} <br />
            <em>Documents: {{ course.documents || 'None listed' }}</em>
          </li>
        </ul>
      </section>
      <p v-else>No courses found. Let’s add one!</p>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  import { useAuthStore } from '../stores/authStore'
  
  const auth = useAuthStore()
  interface Teacher {
  id: number
  name: string
  // Add more fields if needed, like email etc.
}

const teacher = ref<Teacher | null>(null)
  interface Course {
  id: number
  title: string
  fee: number
  description: string
  documents: string
}

const courses = ref<Course[]>([])
  
onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/teacher/courses', {
      headers: { Authorization: `Bearer ${auth.token}` }
    })

    courses.value = res.data
  } catch (err) {
    console.error('Failed to load courses for teacher:', err)
  }
})

  </script>
  
  <style scoped>
  .teacher-dashboard {
    max-width: 800px;
    margin: 3rem auto;
  }
  .courses-section {
    margin-top: 2rem;
  }
  </style>
  