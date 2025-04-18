import { createRouter, createWebHistory } from 'vue-router'
import type { RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import SignupView from '../views/SignupView.vue'
import DashboardView from '../views/DashboardView.vue'
import VideoRoomView from '../views/VideoRoomView.vue'
import ScheduleView from '../views/ScheduleView.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/', name: 'Home', component: HomeView },
  { path: '/login', name: 'Login', component: LoginView },
  { path: '/signup', name: 'Signup', component: SignupView },
  { path: '/dashboard', name: 'Dashboard', component: DashboardView },
  { path: '/video', name: 'Video', component: VideoRoomView },
  { path: '/schedule', name: 'Schedule', component: ScheduleView },
  {
    path: '/payments',
    name: 'Payments',
    component: () => import('../views/PaymentsView.vue')
  },
  {
    path: '/payments/new',
    name: 'AddPayment',
    component: () => import('../views/AddPaymentView.vue')
  }
  
  
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
