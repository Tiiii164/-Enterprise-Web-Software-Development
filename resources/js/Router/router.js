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
//user
import UsersCreate from"../Pages/Users/UsersCreate.vue"
import UsersIndex from "../Pages/Users/UsersIndex.vue"
import UsersUpdate from "../Pages/Users/UsersUpdate.vue"
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
//statistics
import Statistics from "../Pages/Statistics.vue"
const router = createRouter({
    history: createWebHistory(),
    routes: [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/signup',
        name: 'Sign Up',
        component: SignUp
    },
    {
        path: '/signin',
        name: 'Sign In',
        component: SignIn,
    },
    {
        path: '/staffSubmission',
        name: 'Staff Submission',
        component: StaffSub,
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
    //role
    {
        path: '/RolesIndex',
        name: 'RolesIndex',
        component: RolesIndex,
    },
    {
        path: '/RolesCreate',
        name: 'RolesCreate',
        component: RolesCreate,
    },
    {
        path: '/RolesUpdate/:id',
        name: 'RolesUpdate',
        component: RolesUpdate,
    },
    //department
    {
        path: '/DepartmentsIndex',
        name: 'DepartmentsIndex',
        component: DepartmentsIndex,
    },
    {
        path: '/DepartmentsCreate',
        name: 'DepartmentsCreate',
        component: DepartmentsCreate,
    },
    {
        path: '/DepartmentsUpdate/:id',
        name: 'DepartmentsUpdate',
        component: DepartmentsUpdate,
    },
    //category
    {
        path: '/CategoriesIndex',
        name: 'CategoriesIndex',
        component: CategoriesIndex,
    },
    {
        path: '/CategoriesCreate',
        name: 'CategoriesCreate',
        component: CategoriesCreate,
    },
    {
        path: '/CategoriesUpdate/:id',
        name: 'CategoriesUpdate',
        component: CategoriesUpdate,
    },
    //topics
     {
        path: '/TopicsShow/:id',
        name: 'TopicsShow',
        component: TopicsShow,
    },
    {
        path: '/TopicsIndex',
        name: 'TopicsIndex',
        component: TopicsIndex,
    },
    {
        path: '/TopicsCreate',
        name: 'TopicsCreate',
        component: TopicsCreate,
    },
    
    {
        path: '/TopicsUpdate/:id',
        name: 'TopicsUpdate',
        component: TopicsUpdate,
    },
    //user
    {
        path: '/UsersIndex',
        name: 'UsersIndex',
        component: UsersIndex,
    },
    {
        path: '/UsersCreate',
        name: 'UsersCreate',
        component: UsersCreate,
    },
    
    {
        path: '/UsersUpdate/:id',
        name: 'UsersUpdate',
        component: UsersUpdate,
    },
    //ideas
    {
        path: '/IdeasIndex',
        name: 'IdeasIndex',
        component: IdeasIndex,
    },
    {
        path: '/IdeasCreate',
        name: 'IdeasCreate',
        component: IdeasCreate,
    },
    {
        path: '/IdeasUpdate/:id',
        name: 'IdeasUpdate',
        component: IdeasUpdate,
    },
    //Statistics
    {
        path: '/Statistics',
        name: 'Statistics',
        component: Statistics,
    },
]
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('Idea_token'))
}

router.beforeEach((to, from, next) => {

    if (to.path !== '/signup' && to.path !== '/signin' && !isAuthenticated()) {
        return next({path: '/signup'})

    }
    return next()
})

export default router;