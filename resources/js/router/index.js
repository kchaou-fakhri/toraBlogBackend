import VueRouter from 'vue-router'
import vue from 'vue'

vue.use(VueRouter)

import dashboard from '../components/Pages/Dashboard.vue'
import createpost from '../components/Post/Create.vue'

const routes = [
    
    { path : '/createpost', component : createpost },
   
]


const router = new VueRouter({
    mode: 'hash',
    routes
})

export default router;