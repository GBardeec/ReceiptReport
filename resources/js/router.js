import { createWebHistory, createRouter } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('./components/MonthlyReport/Index.vue'),
        name: 'MonthlyReport'
    },
    {
        path: '/:month',
        component: () => import('./components/ReportByDays/Index.vue'),
        name: 'ReportByDays'
    },
    {
        path: '/:date',
        component: () => import('./components/ReportForTheDay/Index.vue'),
        name: 'ReportForTheDay'
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
