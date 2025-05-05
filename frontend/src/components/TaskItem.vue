<template>
  <div class="p-2 border mb-2 flex justify-between">
    <div>{{ task.title }} ({{ task.priority }})</div>
    <div>
      <button @click="$emit('toggle')">Toggle</button>
      <button v-if="isAdmin" @click="$emit('delete')">Delete</button>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from '../store';
const props = defineProps({ task: Object });
const auth = useAuthStore();
const isAdmin = auth.user?.is_admin;
</script>