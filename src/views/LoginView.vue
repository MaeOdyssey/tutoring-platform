<template>
  <div class="login-view">
    <div class="login-container">
      <div class="login-brand">
        <router-link to="/" class="logo">
          <span class="logo-icon">🧠</span>
          <span class="logo-text">LearnTogether</span>
        </router-link>
      </div>

      <div class="login-card">
        <div class="login-header">
          <h1>Welcome Back</h1>
          <p class="subtitle">Sign in to continue your learning journey</p>
        </div>

        <div class="auth-wrapper">
          <AuthenticatorWidget mode="login" />
        </div>

        <div class="login-footer">
          <div class="divider">
            <span>or</span>
          </div>
          <p class="signup-prompt">
            New to LearnTogether? 
            <router-link to="/signup" class="signup-link">Create account</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import AuthenticatorWidget from '../components/AuthenticatorWidget.vue'
</script>

<style scoped>
.login-view {
  background-color: #0f172a;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1.5rem;
}

.login-container {
  max-width: 480px;
  width: 100%;
}

.login-brand {
  text-align: center;
  margin-bottom: 2rem;
}

.logo {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
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

.login-card {
  background: #1e293b;
  border-radius: 1rem;
  padding: 2.5rem;
  border: 1px solid #334155;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.login-header {
  text-align: center;
  margin-bottom: 2rem;
}

.login-header h1 {
  font-size: 2rem;
  color: #f8fafc;
  margin-bottom: 0.75rem;
  line-height: 1.2;
}

.subtitle {
  color: #94a3b8;
  font-size: 1.1rem;
}

.auth-wrapper {
  margin: 2rem 0;
}

.login-footer {
  margin-top: 1.5rem;
}

.divider {
  display: flex;
  align-items: center;
  color: #64748b;
  margin: 1.5rem 0;
  font-size: 0.875rem;
}

.divider::before,
.divider::after {
  content: "";
  flex: 1;
  border-bottom: 1px solid #334155;
}

.divider span {
  padding: 0 1rem;
}

.signup-prompt {
  text-align: center;
  color: #94a3b8;
  font-size: 0.95rem;
}

.signup-link {
  color: #38b6ff;
  font-weight: 500;
  text-decoration: none;
  margin-left: 0.5rem;
  transition: color 0.2s ease;
}

.signup-link:hover {
  color: #7dd3fc;
  text-decoration: underline;
  text-underline-offset: 3px;
}

@media (max-width: 640px) {
  .login-header h1 {
    font-size: 1.75rem;
  }
  
  .login-card {
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