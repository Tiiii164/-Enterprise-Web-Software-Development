<script>
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
        const handleRegister = async () => {
            const response = await axios.post('/api/auth/Register', form)
            .then((res) => {
                localStorage.setItem('token', res.data.data.token);
                localStorage.setItem('username', res.data.data.name);
                router.push({name: 'Login'})
            })
            .catch((e) => {
                    errors.value = "Registration failed"
            })
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
    <div class="container">
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
                            <input type="password" name="password_confirm" v-model="form.password_confirmation" id="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <router-link class="btn btn-danger" to="/Login"> Sign In </router-link>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
    </div>
</template>