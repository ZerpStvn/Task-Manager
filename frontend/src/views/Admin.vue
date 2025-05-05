<template>
  <div>
    <h1>Admin Dashboard</h1>
    <table>
      <tr><th>User</th><th>Total</th><th>Completed</th><th>Pending</th></tr>
      <tr v-for="u in users.data" :key="u.id">
        <td>{{ u.name }}</td>
        <td>{{ u.total }}</td>
        <td>{{ u.completed_count }}</td>
        <td>{{ u.pending_count }}</td>
      </tr>
    </table>
    <button @click="nextPage">Next</button>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';
const users = ref({ data: [] });
onMounted(fetch);
async function fetch(page=1) {
  const { data } = await api.get('admin/users-tasks', { params: { page } });
  users.value = data;
}
function nextPage() { fetch(users.value.current_page+1); }
</script>