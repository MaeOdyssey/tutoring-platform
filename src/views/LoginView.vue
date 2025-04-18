<template>
  <div class="login-view">
    <h2>Welcome Back</h2>

    <AuthenticatorWidget mode="login" />

    <p class="alt-link">
      Need an account?
      <router-link to="/signup">Sign up here</router-link>
    </p>
  </div>
</template>

<script setup lang="ts">
import AuthenticatorWidget from '../components/AuthenticatorWidget.vue'
</script>

<style scoped>
.login-view {
  max-width: 400px;
  margin: 3rem auto;
  padding: 2rem;
  border: 1px solid #d1d5db;
  border-radius: 1rem;
  background: #fff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 1.75rem;
  font-weight: 600;
}

.alt-link {
  text-align: center;
  margin-top: 1rem;
  font-size: 0.95rem;
}
</style>
