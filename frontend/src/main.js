import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const app = createApp(App);
app.use(createPinia());
app.use(router);

window.Pusher = Pusher;
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_KEY,
  wsHost: import.meta.env.VITE_PUSHER_HOST,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
});

app.mount('#app');