<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register Form</h4>
                        <form @submit.prevent="register">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name: </label>
                                <input type="text" name="name" v-model="form.name" id="" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email: </label>
                                <input type="text" name="email" v-model="form.email" id="" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password: </label>
                                <input type="password" name="password" v-model="form.password" id="" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirm Password: </label>
                                <input type="password" name="password_confirm" v-model="form.password_confirm" id="" class="form-control" placeholder="Confirm Password">
                            </div>

                            <div class="mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import axios from "axios"
    import { useRouter } from "vue-router"
    import { reactive } from "vue";
    
    let form = reactive({
        name : '',
        email : '',
        password : '',
        password_confirm : '',
    });

    const router = useRouter();

    const register = async() => {
        const response = await axios.post('/register', form)
            .then((res) => {
                localStorage.setItem('token', res.data.data.token);
                localStorage.setItem('username', res.data.data.name);
                router.push({name: 'Login'})
            })
            .catch((err) => {
                console.log(err)
            })
    }
</script> 