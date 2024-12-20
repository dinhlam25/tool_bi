import { createRouter, createWebHistory } from 'vue-router';
import Login from '../js/Pages/Auth/Login.vue';

const routes = [
    {
    path: '/login',
    name: 'login',
    component: Login,
    },
  // Add other routes here
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;