import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import './assets/global.css'
import '@fortawesome/fontawesome-free/css/all.min.css'
const app = createApp(App)

app.use(createPinia()) // 🧠 ACTIVATE THE STORE
app.use(router)

app.mount('#app')
