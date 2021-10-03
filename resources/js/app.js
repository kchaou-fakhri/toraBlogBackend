
import router from "./router/index";
import VueRouter from 'vue-router'
require('./bootstrap');
import '@fortawesome/fontawesome-free/css/all.css'
window.Vue = require('vue').default;
Vue.use(VueRouter)

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)


const axios = require('axios').default;

Vue.component('mainapp', require('./components/Main.vue').default);


const app = new Vue({
    el: '#app',
    router
});
