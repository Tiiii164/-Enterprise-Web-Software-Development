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
        const handleSignIn = async () => {
            try {
                const result = await axios.post('/api/auth/signin', form)
                if (result.status === 200 && result.data && result.data.token) {
                    localStorage.setItem('Idea_token', result.data.token)
                    await router.push('/')
                }
            } catch (e) {
                if(e && e.response.data && e.response.data.errors) {
                    errors.value = Object.values(e.response.data.errors)
                } else {
                    errors.value = "Sign In Failed"
                }
            }
        }
        return {
            form,
            errors,
            handleSignIn,
        }
    }
}
</script>
<template>
    <div class="login&logout" style="width:auto" >
        <div class="row1 signin" style="position:absolute;width:auto">
            <div class="col-md-8">
                <div class="">
                <div class="card-body">
                    <h4 class="card-title">WELCOME BACK</h4>
                    <h4 class="card-title1">Welcome back! Please enter your details</h4>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{ errors }}</p>
                    <form method="post" @submit.prevent="handleSignIn">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" name="email" v-model="form.email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" v-model="form.password" id="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="d-flex" style="width:auto">
                            <router-link class="buttoncss ml-6" to="/signup"> Sign Up </router-link>
                            <button type="submit" class="buttoncss ml-6">Sign In</button>
                        </div>
                    </form>      
                </div>                

                </div>
            </div>
        </div>
        <div>
            <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsi" style="width:100%">
        </div>
    </div>
</template>