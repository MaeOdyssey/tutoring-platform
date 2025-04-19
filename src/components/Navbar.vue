<template>
  <nav class="navbar">
    <div class="navbar-container">
      <!-- Brand Logo -->
      <router-link to="/" class="brand">
        <span class="brand-name">LearnTogether</span>
      </router-link>

      <!-- Main Navigation -->
      <div class="navigation">
        <router-link to="/discover" class="nav-item">
          <span class="nav-icon">🔍</span>
          <span class="nav-text">Discover</span>
        </router-link>
        
        <router-link to="/teach" class="nav-item highlight">
          <span class="nav-icon">👨‍🏫</span>
          <span class="nav-text">Teach</span>
        </router-link>
      </div>

      <!-- User Actions -->
      <div class="user-actions">
        <router-link to="/login" class="auth-link">
          Sign In
        </router-link>
        <router-link to="/signup" class="auth-button">
          Start Learning
        </router-link>
        <LogoutButton class="logout-btn" />
      </div>
    </div>
  </nav>
</template>

<script lang="ts" setup>
import LogoutButton from '../components/LogoutButton.vue'
</script>

<style scoped>
/* Base Navbar Styles */
.navbar {
  background: #0f172a;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.navbar-container {
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: center;
  max-width: 1440px;
  margin: 0 auto;
  padding: 0.75rem 2rem;
  gap: 2rem;
}

/* Brand Styling */
.brand {
  text-decoration: none;
}

.brand-name {
  font-size: 1.5rem;
  font-weight: 700;
  color: #e2f3ff;
  letter-spacing: -0.5px;
  position: relative;
}

.brand-name::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, #7dd3fc 0%, #38b6ff 100%);
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease;
}

.brand:hover .brand-name::after {
  transform: scaleX(1);
  transform-origin: left;
}

/* Navigation Items */
.navigation {
  display: flex;
  gap: 0.5rem;
  justify-self: center;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.25rem;
  border-radius: 8px;
  text-decoration: none;
  color: #cbd5e1;
  font-weight: 500;
  transition: all 0.3s ease;
}

.nav-item:hover {
  background: rgba(203, 213, 225, 0.05);
  color: #f8fafc;
}

.nav-item.highlight {
  background: rgba(56, 182, 255, 0.1);
  color: #7dd3fc;
}

.nav-item.highlight:hover {
  background: rgba(56, 182, 255, 0.2);
}

.nav-icon {
  font-size: 1.1rem;
}

.nav-text {
  font-size: 0.95rem;
}

/* User Actions */
.user-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.auth-link {
  color: #e2e8f0;
  text-decoration: none;
  font-weight: 500;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.auth-link:hover {
  background: rgba(255, 255, 255, 0.05);
}

.auth-button {
  background: #38b6ff;
  color: #0f172a;
  padding: 0.75rem 1.75rem;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.auth-button:hover {
  background: #0ea5e9;
  transform: translateY(-1px);
}

.logout-btn {
  color: #cbd5e1;
  background: transparent;
  border: none;
  padding: 0.75rem;
  cursor: pointer;
  transition: color 0.3s ease;
}

.logout-btn:hover {
  color: #f8fafc;
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
  .navbar-container {
    grid-template-columns: auto auto;
    justify-content: space-between;
  }
  
  .navigation {
    display: none;
  }
}

@media (max-width: 640px) {
  .navbar-container {
    padding: 0.75rem 1.5rem;
    gap: 1rem;
  }
  
  .brand-name {
    font-size: 1.25rem;
  }
  
  .auth-link {
    padding: 0.5rem 1rem;
    display: none;
  }
  
  .auth-button {
    padding: 0.6rem 1.25rem;
    font-size: 0.9rem;
  }
}
</style>