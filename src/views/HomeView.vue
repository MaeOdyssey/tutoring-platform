<template>
  <div class="home-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1>Master New Skills with <span class="brand-highlight">LearnTogether</span></h1>
        <p class="hero-subtitle">Your professional learning platform for collaborative growth and skill development</p>
        <div class="hero-buttons">
          <router-link to="/login" class="btn btn-primary">Log In</router-link>
          <router-link to="/signup" class="btn btn-secondary">Start Learning Free</router-link>
        </div>
      </div>
    </div>

    <!-- Course Listing -->
    <div class="course-section">
      <div class="section-header">
        <h2>Featured Courses</h2>
        <p>Start your learning journey with these popular courses</p>
      </div>
      
      <div class="courses-grid">
        <div v-for="course in courses" :key="course.id" class="course-card">
          <div class="course-card-header">
            <h3>{{ course.title }}</h3>
          </div>
          <div class="course-card-body">
            <p>{{ course.description }}</p>
            <div class="course-meta">
              <span class="fee-badge">{{ course.fee ? '$' + course.fee : 'FREE' }}</span>
            </div>
          </div>
          <div class="course-card-footer">
            <router-link :to="`/courses/${course.id}`" class="btn btn-small">View Course</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'

interface Course {
  id: number
  title: string
  description: string
  fee: number
}

const courses = ref<Course[]>([])

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/courses')
    courses.value = res.data
  } catch (err) {
    console.error('Failed to fetch courses:', err)
  }
})
</script>

<style scoped>
.home-container {
  max-width: 100%;
  overflow-x: hidden;
}

/* Hero Section */
.hero-section {
  position: relative;
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: 
    linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 100%),
    url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
  background-size: cover;
  background-position: center;
  padding: 2rem;
  color: white;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, rgba(24,24,36,0.9) 0%, rgba(24,24,36,0.7) 100%);
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 800px;
  padding: 2rem;
}

.hero-content h1 {
  font-size: 3rem;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  font-weight: 700;
}

.brand-highlight {
  color: #00b4d8;
}

.hero-subtitle {
  font-size: 1.3rem;
  color: #e2e8f0;
  margin-bottom: 2.5rem;
  line-height: 1.5;
}

.hero-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

/* Course Section */
.course-section {
  background-color: #181824;
  padding: 4rem 2rem;
}

.section-header {
  text-align: center;
  max-width: 800px;
  margin: 0 auto 3rem;
}

.section-header h2 {
  font-size: 2.2rem;
  margin-bottom: 1rem;
  color: white;
}

.section-header p {
  font-size: 1.1rem;
  color: #94a3b8;
}

.courses-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

/* Course Cards */
.course-card {
  background: #242437;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.course-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 180, 216, 0.2);
}

.course-card-header {
  padding: 1.5rem 1.5rem 0;
}

.course-card-header h3 {
  font-size: 1.3rem;
  margin: 0;
  color: white;
}

.course-card-body {
  padding: 1rem 1.5rem;
  flex-grow: 1;
}

.course-card-body p {
  color: #cbd5e1;
  line-height: 1.5;
  margin-bottom: 1.5rem;
}

.course-meta {
  display: flex;
  align-items: center;
}

.fee-badge {
  background: rgba(0, 180, 216, 0.2);
  color: #00b4d8;
  padding: 0.3rem 0.8rem;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.9rem;
}

.course-card-footer {
  padding: 0 1.5rem 1.5rem;
}

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  border-radius: 6px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.btn-primary {
  background-color: #00b4d8;
  color: white;
  padding: 0.8rem 2rem;
}

.btn-primary:hover {
  background-color: #0096c7;
  transform: translateY(-2px);
}

.btn-secondary {
  background-color: transparent;
  color: #00b4d8;
  border: 2px solid #00b4d8;
  padding: 0.8rem 2rem;
}

.btn-secondary:hover {
  background-color: rgba(0, 180, 216, 0.1);
  transform: translateY(-2px);
}

.btn-small {
  padding: 0.6rem 1.2rem;
  font-size: 0.9rem;
  width: 100%;
  background-color: #00b4d8;
  color: white;
}

.btn-small:hover {
  background-color: #0096c7;
}

@media (max-width: 768px) {
  .hero-content h1 {
    font-size: 2.2rem;
  }
  
  .hero-subtitle {
    font-size: 1.1rem;
  }
  
  .hero-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .courses-grid {
    grid-template-columns: 1fr;
  }
}
</style>