import { defineStore } from 'pinia';
import api from '../services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({ user: null, token: null }),
  actions: {
    async login(creds) {
      const { data } = await api.post('login', creds);
      this.user = data.user;
      this.token = data.token;
      api.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
    },
    async logout() {
      await api.post('logout');
      this.user = null;
      this.token = null;
    }
  }
});

export const useTaskStore = defineStore('tasks', {
  state: () => ({ list: [] }),
  actions: {
    async fetch(filters = {}) {
      const { data } = await api.get('tasks', { params: filters });
      this.list = data;
    },
    async create(payload) { await api.post('tasks', payload); this.fetch(); },
    async update(id, payload) { await api.put(`tasks/${id}`, payload); this.fetch(); },
    async delete(id) { await api.delete(`tasks/${id}`); this.fetch(); },
    async reorder(map) { await api.post('tasks/reorder', { order_map: map }); this.fetch(); }
  }
});