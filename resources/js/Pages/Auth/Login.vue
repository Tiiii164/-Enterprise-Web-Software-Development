<script>
import { ref, reactive } from "vue";
import { useRouter } from "vue-router"
export default {
    setup() {
        const errors = ref()
        const router = useRouter();
        const form = reactive({
            email: '',
            password: '',
        })
        const handleLogin = async () => {
            try {
                const result = await axios.post('/api/auth/Login', form)
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('APP_DEMO_USER_TOKEN', result.data.token)
                    await router.push({name:'Home'})
                }
            } catch (e) {
                if(e && e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                } else {
                    errors.value = "Login Failed"
                }
            }
        }
        return {
            form,
            errors,
            handleLogin,
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
                    <h4 class="card-title">Login Form</h4>
                    <ul class="list-disc text-red-400" v-for="(value, index) in errors" :key="index" v-if="typeof errors === 'object'">
                        <li>{{value[0]}}</li>
                    </ul>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                    <form method="post" @submit.prevent="handleLogin">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" name="email" v-model="form.email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" v-model="form.password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <router-link class="btn btn-danger" to="/Register"> Register </router-link>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
    </div>
</template>