import { createWebHistory, createRouter } from "vue-router"
import Home from '../Pages/Home.vue'
import StaffSub from "../Pages/Staff/StaffSubmission.vue"
import SignIn from "../Pages/Auth/SignIn.vue"
import SignUp from "../Pages/Auth/SignUp.vue"
//roles
import RolesCreate from "../Pages/Roles/RolesCreate.vue"
import RolesIndex from "../Pages/Roles/RolesIndex.vue"
import RolesUpdate from "../Pages/Roles/RolesUpdate.vue"
//departments
import DepartmentsCreate from "../Pages/Departments/DepartmentsCreate.vue"
import DepartmentsIndex from "../Pages/Departments/DepartmentsIndex.vue"
import DepartmentsUpdate from "../Pages/Departments/DepartmentsUpdate.vue"
//categories
import CategoriesCreate from "../Pages/Categories/CategoriesCreate.vue"
import CategoriesIndex from "../Pages/Categories/CategoriesIndex.vue"
import CategoriesUpdate from "../Pages/Categories/CategoriesUpdate.vue"
//Topics
import TopicsCreate from "../Pages/Topics/TopicsCreate.vue"
import TopicsIndex from "../Pages/Topics/TopicsIndex.vue"
import TopicsUpdate from "../Pages/Topics/TopicsUpdate.vue"
import TopicsShow from "../Pages/Topics/TopicsShow.vue"
//Ideas
import IdeasCreate from "../Pages/Ideas/IdeasCreate.vue"
import IdeasIndex from "../Pages/Ideas/IdeasIndex.vue"
import IdeasUpdate from "../Pages/Ideas/IdeasUpdate.vue"
//profile
import ShowProfile from "../Pages/Auth/ShowProfile.vue"
import UpdateProfile from "../Pages/Auth/UpdateProfile.vue"
import ChangePassword from "../Pages/Auth/ChangePassword.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [

        //topics
        {
            path: '/topicsCreate',
            name: 'TopicsCreate',
            component: TopicsCreate,
        },
        {
            path: '/topicsIndex',
            name: 'TopicsIndex',
            component: TopicsIndex,
        },
        {
            path: '/topicsUpdate/:id',
            name: 'TopicsUpdate',
            component: TopicsUpdate,
        },
        {
            path: '/TopicsShow/:id',
            name: 'TopicsShow',
            component: TopicsShow,
        },

        //Ideas
        {
            path: '/ideasCreate',
            name: 'IdeasCreate',
            component: IdeasCreate,
        },
        {
            path: '/ideasIndex',
            name: 'IdeasIndex',
            component: IdeasIndex,
        },
        {
            path: '/ideasUpdate/:id',
            name: 'IdeasUpdate',
            component: IdeasUpdate,
        },


        {
            path: '/signup',
            name: 'Sign Up',
            component: SignUp
        },
        {
            path: '/staffSubmission',
            name: 'Staff Submission',
            component: StaffSub,
        },
        {
            path: '/signin',
            name: 'Sign In',
            component: SignIn,
        },
        {
            path: '/',
            name: 'Home',
            component: Home,
        },
        // {
        //     path: '/staffProfile',
        //     name: 'Staff Profile',
        //     component: StaffProfile,
        // },
        // {
        //     path: '/admin',
        //     name: 'Admin',
        //     component: Admin,
        // },
        {
            path: '/rolesCreate',
            name: 'RolesCreate',
            component: RolesCreate,
        },
        {
            path: '/rolesIndex',
            name: 'RolesIndex',
            component: RolesIndex,
        },
        {
            path: '/rolesUpdate/:id',
            name: 'RolesUpdate',
            component: RolesUpdate,
        },
        {
            path: '/DepartmentsCreate',
            name: 'DepartmentsCreate',
            component: DepartmentsCreate,
        },
        {
            path: '/DepartmentsIndex',
            name: 'DepartmentsIndex',
            component: DepartmentsIndex,
        },
        {
            path: '/DepartmentsUpdate/:id',
            name: 'DepartmentsUpdate',
            component: DepartmentsUpdate,
        },
        {
            path: '/CategoriesCreate',
            name: 'CategoriesCreate',
            component: CategoriesCreate,
        },
        {
            path: '/CategoriesIndex',
            name: 'CategoriesIndex',
            component: CategoriesIndex,
        },
        {
            path: '/CategoriesUpdate/:id',
            name: 'CategoriesUpdate',
            component: CategoriesUpdate,
        },
        {
            path: '/ShowProfile',
            name: 'ShowProfile',
            component: ShowProfile,
        },
        {
            path: '/UpdateProfile/:id',
            name: 'UpdateProfile',
            component: UpdateProfile,
        },
    ]

})

function isAuthenticated() {
    return Boolean(localStorage.getItem('Idea_token'))
}

router.beforeEach((to, from, next) => {

    if (to.path !== '/signup' && to.path !== '/signin' && !isAuthenticated()) {
        return next({ path: '/signup' })

    }
    return next()
})

export default router;