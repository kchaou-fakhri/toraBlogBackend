import VueRouter from 'vue-router'
import vue from 'vue'

vue.use(VueRouter)

import dashboard from '../components/Pages/Dashboard.vue'
import createpost from '../components/Post/Create.vue'
import listpost from '../components/Post/PostList.vue'
import editpost from '../components/Post/Edit.vue'

const routes = [
    
    { path : '/createpost', component : createpost },
    { path : '/list', component : listpost },
    { path : '/editpost/:id', component : editpost },
   
]


const router = new VueRouter({
    mode: 'hash',
    routes
})

export default router;