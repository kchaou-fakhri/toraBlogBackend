import VueRouter from 'vue-router'
import vue from 'vue'

vue.use(VueRouter)

//import dashboard from '../components/Pages/Dashboard.vue'
import createpost from '../components/Post/Create.vue'
import listpost from '../components/Post/PostList.vue'
import editpost from '../components/Post/Edit.vue'
import login from '../components/Auth/Login.vue'
import register from '../components/Auth/Register.vue'
import users from '../components/Auth/ListEditor.vue'
import edituser from '../components/Auth/EditUser.vue'
import manageuser from '../components/Role/ManageUsers.vue'


function guardMyroute(to, from, next) {
    var isAuthenticated = false;


    const axios = require('axios');
    axios.get('/api/athenticated').then((result) => {
        next()


    }).catch((err) => {
        return next('/login')
    });

}


function guardLogin(to, from, next) {
    var isAuthenticated = false;


    const axios = require('axios');
    axios.get('/api/athenticated').then((result) => {
        next("/posts")
    }).catch((err) => {
        next()
    });

}

function guardAny(to, from, next) {
    var isAuthenticated = false;


    const axios = require('axios');
    axios.get('/api/athenticated').then((result) => {
        next("/posts")
    }).catch((err) => {
        next('/login')
    });

}


const routes = [


    {
        path: '/createpost', component: createpost,
        beforeEnter: guardMyroute,

    },

    { path: '/posts', component: listpost, name: 'posts', beforeEnter: guardMyroute, },
    { path: '/manage', component: manageuser,  beforeEnter: guardMyroute, },
    { path: '/editpost/:id', component: editpost, beforeEnter: guardMyroute, },
    { path: '/newuser', component: register, beforeEnter: guardMyroute },
    { path: '/users', component: users, beforeEnter: guardMyroute },
    { path: '/edituser/:id', component: edituser, beforeEnter: guardMyroute },

    { path: '/login', component: login, beforeEnter: guardLogin },
    {
        path: '*',
        beforeEnter: guardAny,

    }


]


const router = new VueRouter({
    routes,
    mode: 'history',

})

export default router;