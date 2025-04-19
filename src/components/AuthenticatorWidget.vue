<template>
  <div class="auth-widget">
    <h2>{{ title }}</h2>
    <form @submit.prevent="handleSubmit">
      <!-- Only show name field if registering (students only) -->
      <input
        v-if="mode === 'register'"
        v-model="name"
        type="text"
        placeholder="Name"
        required
      />
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Password" required />
      <button type="submit">{{ buttonLabel }}</button>
    </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/authStore'

const props = defineProps({
  mode: {
    type: String,
    default: 'login',
    validator: (val) => ['login', 'register', 'teacher'].includes(val),
  },
})

const router = useRouter()
const auth = useAuthStore()

// Form fields
const name = ref('')
const email = ref('')
const password = ref('')

// UI text based on mode
const title = computed(() => {
  if (props.mode === 'teacher') return 'Teacher Login'
  return props.mode === 'register' ? 'Create Account' : 'Log In'
})

const buttonLabel = computed(() => {
  if (props.mode === 'teacher') return 'Login as Teacher'
  return props.mode === 'register' ? 'Register' : 'Login'
})

async function handleSubmit() {
  try {
    // Setup request data
    let endpoint = ''
    let payload = {}

    if (props.mode === 'teacher') {
      endpoint = '/api/teacher/login'
      payload = {
        email: email.value,
        password: password.value,
      }
    } else if (props.mode === 'register') {
      endpoint = '/api/register'
      payload = {
        name: name.value,
        email: email.value,
        password: password.value,
      }
    } else {
      endpoint = '/api/login'
      payload = {
        email: email.value,
        password: password.value,
      }
    }

    // 🔥 Send login or register request
    const res = await axios.post(`http://localhost:8000${endpoint}`, payload)

    // Save token to Pinia store
    auth.setToken(res.data.token)

    // Optionally fetch user data (for students only)
    if (props.mode !== 'teacher') {
      await auth.fetchUser()
    }

    // 🎉 Success message
    alert(`${props.mode === 'teacher' ? 'Teacher' : props.mode === 'register' ? 'Registered' : 'Logged in'} successfully!`)

    // Redirect to correct dashboard
    router.push(props.mode === 'teacher' ? '/teacher/dashboard' : '/dashboard')
  } catch (err) {
    console.error(`${props.mode} error:`, err)
    alert(`Something went wrong during ${props.mode}.`)
  }
}
</script>

<style scoped>
.auth-widget {
  max-width: 400px;
  margin: auto;
  padding: 1.5rem;
  background: #1f1f2f;
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(100, 100, 255, 0.2);
  color: #fff;
}

input {
  width: 100%;
  margin-bottom: 0.75rem;
  padding: 0.6rem;
  border: none;
  border-radius: 8px;
}

button {
  padding: 0.6rem 1.2rem;
  background: #4f46e5;
  border: none;
  border-radius: 8px;
  color: white;
  cursor: pointer;
}

button:hover {
  background: #4338ca;
}
</style>
