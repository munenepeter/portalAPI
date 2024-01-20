import {
    createRouter,
    createWebHistory
} from 'vue-router';

import Index from '@/components/Index.vue';
import AuthIndex from '@/components/Auth/Index.vue';

const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/auth',
        name: 'auth.index',
        component: AuthIndex
    },
   
];

export default createRouter({
    history: createWebHistory(),
    routes
});