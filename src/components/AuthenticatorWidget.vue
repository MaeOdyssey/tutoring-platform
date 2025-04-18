<template>
    <div class="auth-widget">
      <h2>{{ title }}</h2>
      <form @submit.prevent="handleSubmit">
        <input v-if="mode === 'register'" v-model="name" type="text" placeholder="Name" required />
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
      validator: (val) => ['login', 'register'].includes(val)
    }
  })
  
  const router = useRouter()
  const name = ref('')
  const email = ref('')
  const password = ref('')
  
  const title = computed(() => props.mode === 'register' ? 'Create Account' : 'Log In')
  const buttonLabel = computed(() => props.mode === 'register' ? 'Register' : 'Login')
  const auth = useAuthStore()
  
  async function handleSubmit() {
  try {
    const endpoint = props.mode === 'register' ? '/api/register' : '/api/login'
    const payload = props.mode === 'register'
      ? { name: name.value, email: email.value, password: password.value }
      : { email: email.value, password: password.value }

    const res = await axios.post(`http://localhost:8000${endpoint}`, payload)

    auth.setToken(res.data.token)

    await auth.fetchUser()
    console.log('User after login:', auth.user)


    alert(`${props.mode === 'register' ? 'Registered' : 'Logged in'} successfully!`)
    router.push('/dashboard')
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
  