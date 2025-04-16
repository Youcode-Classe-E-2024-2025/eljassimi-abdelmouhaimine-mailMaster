// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Register from './components/register.vue';
import Login from "./components/login.vue";

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
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
