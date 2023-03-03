<script>
import axios from 'axios';
import { ref, reactive } from "vue";
import { useRouter } from "vue-router"
    export default {
    setup() {
        const errors = ref()
        const router = useRouter();
        const form = reactive({
            email: '',
            name: '',
            password: '',
            password_confirmation: '',
        })
        const handleSignUp = async (evt) => {
            evt.preventDefault()
            try {
                const result = await axios.post('/api/auth/signup', form)
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('Idea_token', result.data.token)
                    await router.push('/signin')
                }
            } catch(e) {
                if(e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                } else {
                    errors.value = "Sign Up Failed"
                }
            }
        }
        return {
            form,
            errors,
            handleSignUp,
        }
    }
}
</script>
<template>
    <div class="kimetsu">
        <div class="row1">
            <div class="col-md-8 ">
                <div class="">
                <div class="card-body">
                    <h4 class="card-title">START FOR FREE</h4>
                    <h4 class="card-title1">Create new account.</h4>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                    <form method="post" @submit.prevent="handleSignUp">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name: </label>
                            <input type="text" name="name" v-model="form.name" id="username" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" name="email" v-model="form.email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" v-model="form.password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password: </label>
                            <input type="password" name="password_confirm" v-model="form.password_confirmation" id="password_confirm" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departments: </label>
                            <select class="form-select form-control" v-model="form.department_id">
                                <option v-for="data in departments" :value="data.id">{{ data.name }}</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <router-link class="buttoncss ml-16" to="/signin"> Sign In </router-link>
                            <button type="submit" class="buttoncss ml-16">Sign Up</button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
        <div>
            <img src="../../../css/2.jpg" alt="" class="kimetsu-img">
        </div>
    </div>
</template>
