<template>
  <div class="signup-view">
    <div class="signup-container">
      <div class="signup-header">
        <router-link to="/" class="logo">
          <span class="logo-icon">🧠</span>
          <span class="logo-text">LearnTogether</span>
        </router-link>
        <h1>Join Our Learning Community</h1>
        <p>Create your account to start your learning journey</p>
      </div>

      <div class="signup-card">
        <AuthenticatorWidget mode="register" class="auth-widget" />

        <div class="signup-footer">
          <p>Already have an account?</p>
          <router-link to="/login" class="login-link">
            Sign in instead
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import AuthenticatorWidget from '../components/AuthenticatorWidget.vue'
</script>

<style scoped>
.signup-view {
  background-color: #0f172a;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1.5rem;
}

.signup-container {
  max-width: 480px;
  width: 100%;
}

.signup-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.logo {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
  margin-bottom: 1.5rem;
}

.logo-icon {
  font-size: 2rem;
  color: #38b6ff;
}

.logo-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: #f8fafc;
  letter-spacing: -0.5px;
}

.signup-header h1 {
  font-size: 2rem;
  color: #f8fafc;
  margin-bottom: 0.75rem;
  line-height: 1.2;
}

.signup-header p {
  color: #94a3b8;
  font-size: 1.1rem;
}

.signup-card {
  background: #1e293b;
  border-radius: 1rem;
  padding: 2.5rem;
  border: 1px solid #334155;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.auth-widget {
  margin-bottom: 1.5rem;
}

.signup-footer {
  text-align: center;
  margin-top: 1.5rem;
  color: #94a3b8;
  font-size: 0.95rem;
}

.login-link {
  color: #38b6ff;
  font-weight: 500;
  text-decoration: none;
  margin-left: 0.5rem;
  transition: color 0.2s ease;
}

.login-link:hover {
  color: #7dd3fc;
  text-decoration: underline;
  text-underline-offset: 3px;
}

@media (max-width: 640px) {
  .signup-header h1 {
    font-size: 1.75rem;
  }
  
  .signup-card {
    padding: 1.5rem;
  }
  
  .logo-text {
    font-size: 1.25rem;
  }
  
  .logo-icon {
    font-size: 1.5rem;
  }
}
</style>