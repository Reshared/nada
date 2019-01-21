import Vue from 'vue';
import router from './router';
import store from './store';
import Http from './utils/Http';
import Loading from './utils/Loading';

window.http = Http;
window.Vue = Vue;

router.beforeEach((to, from, next) => {
    store.dispatch('fetchUser')
         .then(() => {
             Loading.start();
             if (to.name === 'login') {
                 next({name: 'home'});
             } else {
                 store.dispatch('fetchRolesPermissions')
                     .then(() => {
                         Loading.done();

                         next();
                     })
                     .catch(() => {
                         alert('获取角色权限失败');
                     });
             }
         })
         .catch(() => {
             if (to.name === 'login') {
                 next();
             } else {
                 next({name: 'login'});
             }
         });
});

new Vue({
    el: '#app',
    router,
    store
});