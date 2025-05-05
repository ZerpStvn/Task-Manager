<template>
  <div>
    <div v-for="task in tasks" :key="task.id">
      <TaskItem :task="task" @toggle="toggle(task)" @delete="del(task.id)" />
    </div>
    <button @click="add">Add Task</button>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useTaskStore } from '../store';
import TaskItem from './TaskItem.vue';
const store = useTaskStore();
onMounted(() => store.fetch());
function toggle(t) { store.update(t.id, { status: t.status==='pending'?'completed':'pending' }); }
function del(id) { store.delete(id); }
function add() { /* show TaskForm modal */ }
</script>