<template>
    <div class="teacher-dashboard">
      <div class="dashboard-header">
        <h1>Welcome back, {{ teacher?.name }}</h1>
        <p class="subtitle">Manage your courses and teaching materials</p>
        <router-link to="/create-course" class="btn-create">
          <i class="fas fa-plus"></i> Create New Course
        </router-link>
      </div>
  
      <section class="courses-section">
        <div class="section-header">
          <h2>Your Courses</h2>
          <div class="stats-badge">{{ courses.length }} {{ courses.length === 1 ? 'course' : 'courses' }}</div>
        </div>
  
        <div v-if="courses.length" class="course-grid">
          <div v-for="course in courses" :key="course.id" class="course-card">
            <div class="card-header">
              <h3>{{ course.title }}</h3>
              <span class="price-tag">${{ course.fee }}</span>
            </div>
            <p class="course-description">{{ course.description }}</p>
            <div class="card-footer">
              <div class="documents-info">
                <i class="fas fa-file-alt"></i>
                <span>{{ course.documents || 'No documents' }}</span>
              </div>
              <div class="actions">
                <router-link :to="`/edit-course/${course.id}`" class="btn-edit">
                  <i class="fas fa-edit"></i> Edit
                </router-link>
              </div>
            </div>
          </div>
        </div>
  
        <div v-else class="empty-state">
          <div class="empty-icon">
            <i class="fas fa-book-open"></i>
          </div>
          <h3>No courses yet</h3>
          <p>Get started by creating your first course</p>
          <router-link to="/create-course" class="btn-create">
            <i class="fas fa-plus"></i> Create Course
          </router-link>
        </div>
      </section>
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
  }
  
  interface Course {
    id: number
    title: string
    fee: number
    description: string
    documents: string
  }
  
  const teacher = ref<Teacher | null>(null)
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
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
  }
  
  .dashboard-header {
    margin-bottom: 3rem;
    position: relative;
  }
  
  .dashboard-header h1 {
    font-size: 2.2rem;
    color: #2d3748;
    margin-bottom: 0.5rem;
  }
  
  .subtitle {
    color: #718096;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
  }
  
  .btn-create {
    background-color: #4f46e5;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
  }
  
  .btn-create:hover {
    background-color: #4338ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
  }
  
  .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
  }
  
  .section-header h2 {
    font-size: 1.5rem;
    color: #2d3748;
  }
  
  .stats-badge {
    background-color: #edf2f7;
    color: #4a5568;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.9rem;
    font-weight: 500;
  }
  
  .course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
  }
  
  .course-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
  }
  
  .course-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
  }
  
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
  }
  
  .card-header h3 {
    font-size: 1.2rem;
    color: #2d3748;
    margin: 0;
    flex: 1;
  }
  
  .price-tag {
    background-color: #f0fdf4;
    color: #16a34a;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-left: 1rem;
  }
  
  .course-description {
    color: #4a5568;
    line-height: 1.5;
    flex-grow: 1;
    margin-bottom: 1.5rem;
  }
  
  .card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #edf2f7;
  }
  
  .documents-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #718096;
    font-size: 0.9rem;
  }
  
  .documents-info i {
    color: #4f46e5;
  }
  
  .actions {
    display: flex;
    gap: 0.75rem;
  }
  
  .btn-edit {
    color: #4f46e5;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    transition: all 0.2s ease;
  }
  
  .btn-edit:hover {
    background-color: #eef2ff;
  }
  
  .empty-state {
    text-align: center;
    padding: 3rem;
    background-color: #f8fafc;
    border-radius: 12px;
    border: 1px dashed #cbd5e1;
  }
  
  .empty-icon {
    font-size: 2.5rem;
    color: #a0aec0;
    margin-bottom: 1rem;
  }
  
  .empty-state h3 {
    color: #2d3748;
    margin-bottom: 0.5rem;
  }
  
  .empty-state p {
    color: #718096;
    margin-bottom: 1.5rem;
  }
  
  @media (max-width: 768px) {
    .course-grid {
      grid-template-columns: 1fr;
    }
    
    .dashboard-header h1 {
      font-size: 1.8rem;
    }
    
    .section-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;
    }
  }
  </style>