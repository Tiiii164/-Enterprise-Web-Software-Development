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
    <div class="login&logout" style="width:auto" >
        <div class="row1 signup" style="position:absolute;width:auto">
            <div class="col-md-16">
                <div class="">
                <div class="card-body">
                    <h4 class="card-title">START FOR FREE</h4>
                    <h4 class="card-title1">Create new account.</h4>
                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                    <form method="post" @submit.prevent="handleSignUp">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name: </label>
                            <input type="text" name="name" v-model="form.name" id="username"  class="border" placeholder=" Enter Name" plain>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" name="email" v-model="form.email"  id="email" class="border" placeholder=" Enter Email" plain>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: </label>
                            <input type="password" name="password" v-model="form.password" id="password" class="border" placeholder=" Enter Password" plain>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password: </label>
                            <input type="password" name="password_confirm" v-model="form.password_confirmation" class="border" id="password_confirm"  placeholder=" Confirm Password">
                        </div>
                        <div class="d-flex" style="width:auto">
                            <router-link class="buttoncss ml-6" to="/signin"> Sign In </router-link>
                            <button type="submit" class="buttoncss ml-6">Sign Up</button>
                        </div>
                    </form>      
                </div>                
                </div>
            </div>
        </div>
        <div>
            <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
        </div>
    </div>
</template>
