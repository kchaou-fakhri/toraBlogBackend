
import router from "./router/index";
import VueRouter from 'vue-router'
require('./bootstrap');
import '@fortawesome/fontawesome-free/css/all.css'
window.Vue = require('vue').default;
Vue.use(VueRouter)


const axios = require('axios').default;

Vue.component('mainapp', require('./components/Main.vue').default);


const app = new Vue({
    el: '#app',
    router
});
