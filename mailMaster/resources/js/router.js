// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Register from './components/register.vue';
import Login from "./components/login.vue";
import Dashboard from "./components/dashboard.vue";

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
