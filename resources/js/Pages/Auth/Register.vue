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
        const handleRegister = async (evt) => {
            evt.preventDefault()
            try {
                const result = await axios.post('/api/auth/Register', form)
                if (result.status === 200 && result.data && result.data.token) {
                localStorage.setItem('Idea_token', result.data.token)
                await router.push('/Login')
                }
            }catch(e) {
                if(e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                }
            }
        }
        return {
            form,
            errors,
            handleRegister,
            }
    }
}
</script>
<template>
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Register Form</h4>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                    <form method="post" @submit.prevent="handleRegister">
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
                        <div class="d-flex justify-content-between">
                            <router-link class="btn btn-danger" to="/Login"> Login </router-link>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
    </div>
</template>
