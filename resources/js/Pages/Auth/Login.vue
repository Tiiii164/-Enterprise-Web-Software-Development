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
            password: '',
        })
        const handleLogin = async () => {
            try {
                const result = await axios.post('/api/auth/Login', form)
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('Idea_token', result.data.token)
                    await router.push('/')
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
    <div class="kimetsu">
        <div class="row1">
            <div class="col-md-8">
                <div class="">
                <div class="card-body">
                    <h1 class="card-title">Welcome back</h1>
                    <h2 class="card-title1">Hello User! Please enter your details</h2>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                    <form method="post" @submit.prevent="handleLogin">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" name="email" v-model="form.email" id="email" class="border" placeholder=" Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" v-model="form.password" id="password" class="border" placeholder=" Enter Password">
                        </div>
                        <div class="d-flex justify-center">
                            <router-link class="buttoncss ml-16" to="/Register"> Register </router-link>
                            <button type="submit" class="buttoncss ml-16"> Login </button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
        <div>
            <img src="../../../css/kimetsu.png" alt="" class="kimetsu-img">
        </div>
    </div>
</template>