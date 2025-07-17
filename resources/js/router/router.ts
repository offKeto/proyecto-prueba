import { createRouter, createWebHistory } from 'vue-router';
import Contact from '../components/contact-component/ContactComponent.vue';
import Home from '../components/home-component/Home.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/contact', component: Contact },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
