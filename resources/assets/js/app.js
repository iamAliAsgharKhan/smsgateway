
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
 * Vue Progress bar
 *
 * @link https://www.npmjs.com/package/vue-progressbar#installation
 */
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: '#2ECC71',
    failedColor: '#E74C3C',
    thickness: '3px'
});

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
    },
    {
        path: '/user',
        name: 'user.index',
        component: require('./components/user/Index.vue')
    },
    {
        path: '/profile',
        name: 'user.profile',
        component: require('./components/user/Profile.vue')
    },
    {
        path: '/password',
        name: 'user.password',
        component: require('./components/user/Password.vue')
    },
    {
        path: '/notification',
        name: 'user.notification',
        component: require('./components/user/Notification.vue')
    },
    {
        path: '/user/:id',
        name: 'user.view',
        component: require('./components/user/View.vue')
    }
]

const router = new VueRouter({ routes });

/*
 * By extending the Vue prototype with a new '$bus' property
 * we can easily access our global event bus from any child component.
 *
 * @link https://laracasts.com/discuss/channels/vue/use-a-global-event-bus
 */
Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
});
window.bus = new Vue({});

const app = new Vue({
  router,
  data: {
      name: Laravel.name,
      user: {
          auth: Laravel.user.auth,
          data: Laravel.user.data,
          totalNotification: 0
      },
      bus: bus
  }
}).$mount('#app');
