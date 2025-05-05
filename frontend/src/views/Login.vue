<template>
  <form @submit.prevent="doLogin">
    <input v-model="email" placeholder="Email" />
    <input type="password" v-model="password" placeholder="Password" />
    <button>Login</button>
  </form>
</template>
<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../store';
const email = ref(''); const password = ref('');
const auth = useAuthStore();
async function doLogin() {
  await auth.login({ email: email.value, password: password.value });
  location.href = '/';
}
</script>