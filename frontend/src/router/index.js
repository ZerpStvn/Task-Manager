import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Dashboard from '../views/Dashboard.vue';
import Admin from '../views/Admin.vue';
import { useAuthStore } from '../store';

const routes = [
  { path: '/login', component: Login },
  { path: '/', component: Dashboard, meta: { auth: true } },
  { path: '/admin', component: Admin, meta: { auth: true, admin: true } },
];

const router = createRouter({ history: createWebHistory(), routes });

router.beforeEach((to, from, next) => {
  const auth = useAuthStore();
  if (to.meta.auth && !auth.user) return next('/login');
  if (to.meta.admin && !auth.user.is_admin) return next('/');
  next();
});

export default router;