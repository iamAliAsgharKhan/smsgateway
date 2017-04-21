
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

Vue.component('pagination', view('common/Pagination'));
Vue.component('button-delete', view('common/ButtonDelete'));

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
 * @link http://routerjs.org/en/installation.html
 */
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * @param  {string}   name     the filename (basename) of the view to load.
 */
function view(name) {
    return function(resolve) {
        require(['./components/' + name + '.vue'], resolve);
    }
};

// define routes for users
const routes = [
    {
        path: '/',
        name: 'index',
        component: view('app/Index')
    },
    {
        path: '/contact',
        name: 'contact.index',
        component: view('contact/Index')
    },
    {
        path: '/contact/create',
        name: 'contact.create',
        component: view('contact/Create')
    },
    {
        path: '/contact/:id',
        name: 'contact.view',
        component: view('contact/View')
    },
    {
        path: '/message',
        name: 'message.index',
        component: view('message/Index')
    },
    {
        path: '/message/send',
        name: 'message.send',
        component: view('message/Send')
    },
    {
        path: '/message/reply/:id',
        name: 'message.reply',
        component: view('message/Reply')
    },
    {
        path: '/setting',
        name: 'setting',
        component: view('setting/General')
    },
    {
        path: '/user',
        name: 'user.index',
        component: view('user/Index')
    },
    {
        path: '/profile',
        name: 'user.profile',
        component: view('user/Profile')
    },
    {
        path: '/password',
        name: 'user.password',
        component: view('user/Password')
    },
    {
        path: '/notification',
        name: 'user.notification',
        component: view('user/Notification')
    },
    {
        path: '/user/:id',
        name: 'user.view',
        component: view('user/View')
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
