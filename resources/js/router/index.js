import VueRouter from 'vue-router'
import vue from 'vue'

vue.use(VueRouter)

import dashboard from '../components/Pages/Dashboard.vue'
import createpost from '../components/Post/Create.vue'
import listpost from '../components/Post/PostList.vue'
import editpost from '../components/Post/Edit.vue'
import login from '../components/Auth/Login.vue'
import register from '../components/Auth/Register.vue'


const routes = [
    
    { path : '/createpost', component : createpost },
    { path : '/', component : listpost },
    { path : '/editpost/:id', component : editpost },
    { path : '/login', component : login },
    { path : '/register', component : register },
   
]


const router = new VueRouter({
    mode: 'hash',
    routes
})

export default router;