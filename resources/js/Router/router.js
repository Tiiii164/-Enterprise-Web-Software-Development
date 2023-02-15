import {createWebHistory, createRouter } from "vue-router"
import Home from '../Components/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import StaffProfile from "../Pages/Staff/StaffProfile.vue"
import Login from "../Pages/Auth/Login.vue"
import Register from "../Pages/Auth/Register.vue"

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
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
        path: '/Register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/StaffProfile',
        name: 'Staff Profile',
        component: StaffProfile,
    },

];

const router = createRouter ({
    history: createWebHistory(),
    routes
});

export default router;