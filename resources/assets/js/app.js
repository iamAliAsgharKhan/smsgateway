
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('pagination', require('./components/common/Pagination.vue'));
Vue.component('button-delete', require('./components/common/ButtonDelete.vue'));

/**
 * Vue Router
 *
 * @link http://router.vuejs.org/en/installation.html
 */
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// define routes for users
const routes = [
    {
        path: '/',
        name: 'index',
        component: require('./components/app/Index.vue')
    },
    {
        path: '/message',
        name: 'message.index',
        component: require('./components/message/Index.vue')
    },
    {
        path: '/message/send',
        name: 'message.send',
        component: require('./components/message/Send.vue')
    },
    {
        path: '/message/reply/:id',
        name: 'message.reply',
        component: require('./components/message/Reply.vue')
    },
    {
        path: '/setting',
        name: 'setting',
        component: require('./components/setting/General.vue')
    }
]

const router = new VueRouter({ routes });

const app = new Vue({
  router,
  data: {
      user: {
          auth: Laravel.user.auth
      }
  }
}).$mount('#app');
