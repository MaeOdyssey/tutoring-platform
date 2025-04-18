<template>
  <div class="signup-view">
    <h2>Create Your Account</h2>

    <AuthenticatorWidget mode="register" />

    <p class="alt-link">
      Already have an account?
      <router-link to="/login">Log in</router-link>
    </p>
  </div>
</template>

<script lang="ts" setup>
import AuthenticatorWidget from '../components/AuthenticatorWidget.vue'
</script>

<style scoped>
.signup-view {
  max-width: 400px;
  margin: 3rem auto;
  padding: 2rem;
  border: 1px solid #d1d5db;
  border-radius: 1rem;
  background: #fff;
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
}

.alt-link {
  text-align: center;
  margin-top: 1rem;
}
</style>
