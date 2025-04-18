import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') || '',
    user: null as null | { name: string; email: string }
  }),
  actions: {
    setToken(token: string) {
      this.token = token
      localStorage.setItem('token', token)
    },
    async fetchUser() {
      try {
        const res = await axios.get('http://localhost:8000/api/me', {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        })
        this.user = res.data
      } catch (err) {
        console.error('Failed to fetch user:', err)
        this.user = null
      }
    },
    logout() {
      this.token = ''
      this.user = null
      localStorage.removeItem('token')
    }
  },
  getters: {
    isLoggedIn: (state) => !!state.token
  }
})
