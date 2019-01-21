import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('./views/Home')
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('./views/Login')
        },
        {
            path: '/:source/',
            name: 'list',
            component: () => import('./views/List')
        },
        {
            path: '/:source/:id/edit',
            name: 'edit',
            component: () => import('./views/Edit')
        },
        {
            path: '/:source/create',
            name: 'create',
            component: () => import('./views/Edit')
        },
        {
            path: '/:source/:id',
            name: 'show',
            component: () => import('./views/Show')
        }
    ]
});