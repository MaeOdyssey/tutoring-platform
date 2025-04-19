<template>
    <div class="teach-landing">
      <!-- Hero Section -->
      <section class="hero-section">
        <div class="hero-content">
          <h1>Share Your Knowledge on <span class="brand-gradient">LearnTogether</span></h1>
          <p class="hero-subtitle">
            Join our community of educators and create meaningful learning experiences
            with our powerful teaching tools.
          </p>
          <div class="hero-actions">
            <router-link to="/register-teacher" class="btn-primary">
              Get Started
            </router-link>
            <router-link to="/teacher-demo" class="btn-secondary">
              See How It Works
            </router-link>
          </div>
        </div>
        <div class="hero-graphic"></div>
      </section>
  
      <!-- Benefits Section -->
      <section class="benefits-section">
        <div class="section-header">
          <h2>Why Educators Choose Us</h2>
          <p>Everything you need to build your teaching practice</p>
        </div>
  
        <div class="benefits-grid">
          <div class="benefit-card">
            <div class="benefit-icon">👩‍🏫</div>
            <h3>Build Your Brand</h3>
            <p>Establish yourself as an expert with your own educator profile and portfolio.</p>
          </div>
  
          <div class="benefit-card">
            <div class="benefit-icon">📊</div>
            <h3>Earn More</h3>
            <p>Competitive revenue sharing and multiple monetization options.</p>
          </div>
  
          <div class="benefit-card">
            <div class="benefit-icon">🛠️</div>
            <h3>Powerful Tools</h3>
            <p>Course builder, analytics, and communication tools designed for educators.</p>
          </div>
  
          <div class="benefit-card">
            <div class="benefit-icon">🌍</div>
            <h3>Reach Students</h3>
            <p>Access to our global community of motivated learners.</p>
          </div>
        </div>
      </section>
  
      <!-- Testimonials Section -->
      <section class="testimonials-section">
        <div class="section-header">
          <h2>Hear From Our Teachers</h2>
          <p>Join thousands of educators making an impact</p>
        </div>
  
        <div class="testimonials-grid">
          <div class="testimonial-card">
            <div class="testimonial-content">
              "LearnTogether gave me the tools to turn my expertise into a thriving teaching practice."
            </div>
            <div class="testimonial-author">
              <div class="author-avatar">👩‍💻</div>
              <div class="author-info">
                <div class="author-name">Dr. Sarah Chen</div>
                <div class="author-title">Computer Science Educator</div>
              </div>
            </div>
          </div>
  
          <div class="testimonial-card">
            <div class="testimonial-content">
              "The community support and teaching resources are unparalleled. I've doubled my student engagement."
            </div>
            <div class="testimonial-author">
              <div class="author-avatar">🧑‍🎨</div>
              <div class="author-info">
                <div class="author-name">Marcus Rodriguez</div>
                <div class="author-title">Digital Arts Instructor</div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- CTA Section -->
      <section class="cta-section">
        <h2>Ready to Begin Your Teaching Journey?</h2>
        <p>Join our platform and start making an impact today</p>
        <router-link to="/register-teacher" class="btn-primary btn-large">
          Apply to Teach
        </router-link>
      </section>
    </div>
  </template>
  
  <script setup lang="ts">
  // Can add data fetching later if needed
  </script>
  
  <style scoped>
  .teach-landing {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }
  
  /* Hero Section */
  .hero-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
    padding: 4rem 0;
    margin-bottom: 4rem;
  }
  
  .hero-content {
    max-width: 600px;
  }
  
  .hero-content h1 {
    font-size: 2.75rem;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: #f8fafc;
  }
  
  .brand-gradient {
    background: linear-gradient(90deg, #7dd3fc 0%, #38b6ff 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  
  .hero-subtitle {
    font-size: 1.25rem;
    color: #cbd5e1;
    margin-bottom: 2rem;
    line-height: 1.6;
  }
  
  .hero-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
  }
  
  .hero-graphic {
    background: linear-gradient(135deg, rgba(56, 182, 255, 0.1) 0%, rgba(125, 211, 252, 0.1) 100%);
    border-radius: 1rem;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  
  .hero-graphic::after {
    content: "👩‍🏫";
    font-size: 10rem;
    opacity: 0.15;
    position: absolute;
  }
  
  /* Benefits Section */
  .benefits-section {
    padding: 4rem 0;
    margin-bottom: 4rem;
  }
  
  .section-header {
    text-align: center;
    margin-bottom: 3rem;
  }
  
  .section-header h2 {
    font-size: 2.25rem;
    color: #f8fafc;
    margin-bottom: 0.75rem;
  }
  
  .section-header p {
    color: #94a3b8;
    font-size: 1.1rem;
  }
  
  .benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
  }
  
  .benefit-card {
    background: #1e293b;
    border-radius: 1rem;
    padding: 2rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #334155;
  }
  
  .benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }
  
  .benefit-icon {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
  }
  
  .benefit-card h3 {
    color: #f8fafc;
    margin-bottom: 1rem;
    font-size: 1.25rem;
  }
  
  .benefit-card p {
    color: #cbd5e1;
    line-height: 1.6;
  }
  
  /* Testimonials Section */
  .testimonials-section {
    padding: 4rem 0;
    margin-bottom: 4rem;
  }
  
  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
  }
  
  .testimonial-card {
    background: #1e293b;
    border-radius: 1rem;
    padding: 2rem;
    border: 1px solid #334155;
  }
  
  .testimonial-content {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #e2e8f0;
    font-style: italic;
    margin-bottom: 1.5rem;
    position: relative;
  }
  
  .testimonial-content::before {
    content: '"';
    font-size: 3rem;
    color: #38b6ff;
    opacity: 0.2;
    position: absolute;
    top: -1rem;
    left: -1rem;
  }
  
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .author-avatar {
    font-size: 1.5rem;
    background: rgba(56, 182, 255, 0.1);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .author-name {
    font-weight: 600;
    color: #f8fafc;
  }
  
  .author-title {
    font-size: 0.9rem;
    color: #94a3b8;
  }
  
  /* CTA Section */
  .cta-section {
    text-align: center;
    padding: 4rem 0;
    background: linear-gradient(135deg, rgba(56, 182, 255, 0.1) 0%, rgba(125, 211, 252, 0.1) 100%);
    border-radius: 1rem;
    margin-bottom: 4rem;
  }
  
  .cta-section h2 {
    font-size: 2rem;
    color: #f8fafc;
    margin-bottom: 1rem;
  }
  
  .cta-section p {
    color: #cbd5e1;
    font-size: 1.1rem;
    margin-bottom: 2rem;
  }
  
  .btn-large {
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
  }
  
  /* Responsive Design */
  @media (max-width: 1024px) {
    .hero-section {
      grid-template-columns: 1fr;
      text-align: center;
    }
  
    .hero-content {
      max-width: 100%;
    }
  
    .hero-actions {
      justify-content: center;
    }
  
    .hero-graphic {
      height: 300px;
      margin-top: 2rem;
    }
  }
  
  @media (max-width: 640px) {
    .hero-content h1 {
      font-size: 2rem;
    }
  
    .hero-subtitle {
      font-size: 1.1rem;
    }
  
    .hero-actions {
      flex-direction: column;
      align-items: center;
    }
  
    .section-header h2 {
      font-size: 1.75rem;
    }
  }
  </style>