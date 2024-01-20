import {
    createRouter,
    createWebHistory
} from 'vue-router';

import Index from '@/components/Index.vue';
import Login from '@/components/Auth/Login.vue';
import Success from '@/components/Auth/Success.vue';


const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/login/success',
        name: 'login.success',
        component: Success,
    },
   
];

export default createRouter({
    history: createWebHistory(),
    routes
});