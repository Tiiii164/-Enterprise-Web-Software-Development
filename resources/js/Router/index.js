import {createWebHistory, createRouter } from "vue-router"
import StaffHome from "../Pages/Staff/StaffHome.vue"
import StaffSub from "../Pages/Staff/StaffSubmission.vue"

const routes = [
    {
        path: '/StaffHome',
        name: 'Staff Home',
        component: StaffHome,
    },
    {
        path: '/StaffSubmission',
        name: 'Staff Submission',
        component: StaffSub,
    },

];

const router = createRouter ({
    history: createWebHistory(),
    routes
});

export default router;