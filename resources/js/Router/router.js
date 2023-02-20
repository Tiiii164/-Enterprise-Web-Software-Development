import {createWebHistory, createRouter } from "vue-router"
import Home from '../Pages/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import StaffProfile from "../Pages/Staff/StaffProfile.vue"
import Login from "../Pages/Auth/Login.vue"
import Register from "../Pages/Auth/Register.vue"

const router = createRouter ({
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
        path: '/Home',
        name: 'Home',
        component: Home,
    },
    {
        path: '/StaffProfile',
        name: 'Staff Profile',
        component: StaffProfile,
    },

]
})

router.beforeEach((to, from, next) => {
    if (to.path !== '/Register' && to.path !== '/Login' && !isAuthenticated()) {
        return next({path: '/Register'})
    }
    return next()
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('Idea_token'))
}

export default router;