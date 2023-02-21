import { createWebHistory, createRouter } from "vue-router"
import Home from '../Pages/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import StaffProfile from "../Pages/Staff/StaffProfile.vue"
import Login from "../Pages/Auth/Login.vue"
import Register from "../Pages/Auth/Register.vue"
import Admin from "../Pages/Admin/Admin.vue"
//roles
import RolesCreate from "../Pages/Roles/RolesCreate.vue"
import RolesIndex from "../Pages/Roles/RolesIndex.vue"
import RolesUpdate from "../Pages/Roles/RolesUpdate.vue"
//topics
import TopicsCreate from "../Pages/Topics/TopicsCreate.vue"
import TopicsIndex from "../Pages/Topics/TopicsIndex.vue"
import TopicsUpdate from "../Pages/Topics/TopicsUpdate.vue"


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/Register',
            name: 'Register',
            component: Register
        },
        {
            path: '/StaffSubmission',
            name: 'Staff Submission',
            component: StaffSub,
        },
        {
            path: '/Login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/',
            name: 'Home',
            component: Home,
        },
        {
            path: '/StaffProfile',
            name: 'Staff Profile',
            component: StaffProfile,
        },
        {
            path: '/Admin',
            name: 'Admin',
            component: Admin,
        },
        //roles
        {
            path: '/RolesCreate',
            name: 'RolesCreate',
            component: RolesCreate,
        },
        {
            path: '/RolesIndex',
            name: 'RolesIndex',
            component: RolesIndex,
        },
        {
            path: '/RolesUpdate/:id',
            name: 'RolesUpdate',
            component: RolesUpdate,
        },

        //topics
        {
            path: '/TopicsCreate',
            name: 'TopicsCreate',
            component: TopicsCreate,
        },
        {
            path: '/TopicsIndex',
            name: 'TopicsIndex',
            component: TopicsIndex,
        },
        {
            path: '/TopicsUpdate/:id',
            name: 'TopicsUpdate',
            component: TopicsUpdate,
        },

    ]
})

router.beforeEach((to, from, next) => {
    if (to.path !== '/Register' && to.path !== '/Login' && !isAuthenticated()) {
        return next({ path: '/Register' })
    }
    return next()
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('Idea_token'))
}

export default router;