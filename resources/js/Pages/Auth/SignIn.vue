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
    
    const validateEmail = () => {
      const email = document.getElementById('email');
      const emailError = document.getElementById('emailError');
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if(!form.email || !re.test(form.email)) {
        email.classList.add('is-invalid');
        emailError.textContent = 'Please enter a valid email address';
        return false;
      } else {
        email.classList.remove('is-invalid');
        emailError.textContent = '';
        return true;
      }
    }

    const validatePassword = () => {
      const password = document.getElementById('password');
      const passwordError = document.getElementById('passwordError');
      if(!form.password || form.password.length < 3) {
        password.classList.add('is-invalid');
        passwordError.textContent = 'Please enter a password that is at least 3 characters long';
        return false;
      } else {
        password.classList.remove('is-invalid');
        passwordError.textContent = '';
        return true;
      }
    }
    
    const handleSignIn = async () => {
      if(validateEmail() && validatePassword()) {
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
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="navbar-brand text-center mt-4 start-50">
          <img src="../../../css/logoUoG.png" alt="Logo">
        </div>
        <p class="list-disc text-danger" v-if="typeof errors === 'string'">{{ errors }}</p>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          <form method="post" @submit.prevent="handleSignIn" id="signInForm" style="width: 23rem;">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign In</h3>
            <div class="form-outline mb-4">
              <label for="email" class="form-label">Email address</label>
              <input type="text" name="email" v-model="form.email" id="email" class="form-control form-control-lg">
              <span id="emailError" style="color:red;"></span>
            </div>
            <div class="form-outline mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" v-model="form.password" id="password" class="form-control form-control-lg">
              <span id="passwordError" style="color:red;"></span>
            </div>
            <div class="pt-1 mb-4">
              <button type="submit" class="btn btn-info btn-lg btn-block text-light">Sign in</button>
            </div>
            <p>Don't have an account? <router-link class="link-info" to="/signup">Sign Up here </router-link></p>
          </form>
        </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="../../../css/UoGI.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
</template>
<style>
.bg-image-vertical {
  position: relative;
  overflow: hidden;
  background-repeat: no-repeat;
  background-position: right center;
  background-size: auto 100%;
}
@media (min-width: 1000px) {
  .h-custom-2 {
    height: 80%;
  }
}
</style>