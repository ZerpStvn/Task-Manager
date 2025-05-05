<template>
  <form @submit.prevent="submit">
    <input v-model="title" placeholder="Title" />
    <textarea v-model="description" placeholder="Desc"></textarea>
    <select v-model="priority">
      <option>low</option><option>medium</option><option>high</option>
    </select>
    <button type="submit">Save</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import { useTaskStore } from '../store';
const title = ref(''); const description = ref(''); const priority = ref('medium');
const store = useTaskStore();
function submit() {
  store.create({ title: title.value, description: description.value, priority: priority.value });
}
</script>