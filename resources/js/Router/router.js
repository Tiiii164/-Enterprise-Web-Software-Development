import {createWebHistory, createRouter } from "vue-router"
import Home from '../Components/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import StaffProfile from "../Pages/Staff/StaffProfile.vue"
import Login from "../Pages/Auth/Login.vue"
import Register from "../Pages/Auth/Register.vue"
import Admin from "../Pages/Admin/Admin.vue"
import RolesCreate from "../Pages/Roles/RolesCreate.vue"
import RolesIndex from "../Pages/Roles/RolesIndex.vue"
import RolesUpdate from "../Pages/Roles/RolesUpdate.vue"

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

];

const router = createRouter ({
    history: createWebHistory(),
    routes
});

export default router;