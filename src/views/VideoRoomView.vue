<template>
    <div class="video-room">
      <h2>Live Tutoring Session</h2>
      <div class="video-container">
        <iframe
          :src="jitsiUrl"
          allow="camera; microphone; fullscreen; display-capture"
          width="100%"
          height="500"
          style="border:0; border-radius: 1rem;"
        ></iframe>
      </div>
      <button class="btn" @click="leaveRoom">Leave Session</button>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  
  const router = useRouter()
  
  // Generate or set your room name
  const roomName = 'LearnTogetherRoom123'  // <- you can randomize this later
  const jitsiUrl = ref(`https://meet.jit.si/${roomName}`)
  
  function leaveRoom() {
    router.push('/dashboard')
  }
  </script>
  
  <style scoped>
  .video-room {
    max-width: 800px;
    margin: 3rem auto;
    text-align: center;
  }
  
  .video-container {
    margin: 2rem 0;
    border: 2px dashed #9ca3af;
    border-radius: 1rem;
    overflow: hidden;
  }
  
  .btn {
    padding: 0.75rem 1.5rem;
    background-color: #4f46e5;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
  }
  
  .btn:hover {
    background-color: #3730a3;
  }
  </style>
  