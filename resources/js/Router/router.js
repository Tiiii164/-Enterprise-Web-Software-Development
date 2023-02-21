import {createWebHistory, createRouter } from "vue-router"
import Home from '../Pages/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import StaffProfile from "../Pages/Staff/StaffProfile.vue"
import Login from "../Pages/Auth/Login.vue"
import Register from "../Pages/Auth/Register.vue"
import Admin from "../Pages/Admin/Admin.vue"
import RolesCreate from "../Pages/Roles/RolesCreate.vue"
import RolesIndex from "../Pages/Roles/RolesIndex.vue"
import RolesUpdate from "../Pages/Roles/RolesUpdate.vue"

const router = createRouter ({
    history: createWebHistory(),
    routes: [
    {
        path: '/register',
        name: 'Register',
        component: Register
      },
    {
        path: '/StaffSubmission',
        name: 'Staff Submission',
        component: StaffSub,
    },
    {
        path: '/login',
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

]
})

router.beforeEach((to, from, next) => {
    if (to.path !== '/register' && to.path !== '/login' && !isAuthenticated()) {
        return next({path: '/register'})
    }
    return next()
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('Idea_token'))
}

export default router;