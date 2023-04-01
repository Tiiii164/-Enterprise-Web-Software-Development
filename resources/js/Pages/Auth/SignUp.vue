<script>
import axios from 'axios';
import { ref, reactive } from "vue";
import { useRouter } from "vue-router"
export default {
    data() {
        return {
            departments: [],
        }
    },
    setup() {
        const errors = ref()
        const router = useRouter();
        const form = reactive({
            email: '',
            name: '',
            password: '',
            password_confirmation: '',
            department: '',
        })
        const handleSignUp = async (evt) => {
  evt.preventDefault();
  if (!form.email.match(/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/)) {
    errors.value = "Please enter a valid email address";
    return;
  }
  if (form.password.length < 3) {
    errors.value = "Password must be at least 3 characters long";
    return;
  }
  try {
  const result = await axios.post('/api/auth/signup', form);
  if (result.status === 200 && result.data && result.data.token) {
    localStorage.setItem('Idea_token', result.data.token);
    await router.push('/signin');
    // show success message
    const customAlert = document.createElement('div');
        customAlert.classList.add('custom-alert');
        customAlert.innerHTML = `
          <div class="custom-alert-content">
            <h3>Sign Up successfully!</h3>
            <button class="custom-alert-button">OK</button>
          </div>
        `;
        document.body.appendChild(customAlert);
        const customAlertButton = customAlert.querySelector('.custom-alert-button');
        customAlertButton.addEventListener('click', () => {
          customAlert.remove();
        });
    // hide success message after 3 seconds
    setTimeout(() => {
      alertDiv.style.display = 'none';
    }, 3000);
    // provide next steps
  }
}catch(e) {
    if(e.response.data && e.response.data.errors) {
      errors.value = Object.values(e.response.data.errors);
    } else {
      errors.value = "Sign Up Failed";
    }
  }
}

        return {
            form,
            errors,
            handleSignUp,
        }
    },
    methods: {
        async getDepartments() {
            axios.get('/api/departments/DepartmentsSelect')    
            .then((response) => { 
                this.departments = response.data;
            });
        }
    },
    mounted() {
        this.getDepartments();
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
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          <form method="post" @submit.prevent="handleSignUp" id="signInForm" style="width: 23rem;">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up</h3>
            <p class="list-disc text-danger" v-if="typeof errors === 'string'">{{ errors }}</p>
            <div class="form-outline mb-2">
                <label class="form-label">Name </label>
                <input type="text" name="name" v-model="form.name" id="username" class="form-control form-control-lg" plain>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label">Email address</label>
                <input type="email" name="email" v-model="form.email" id="email" class="form-control form-control-lg" plain>
                <span id="emailError" style="color:red;"></span>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" v-model="form.password" id="password" class="form-control form-control-lg" plain>
                <span id="passwordError" style="color:red;"></span>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirm" v-model="form.password_confirmation" id="password_confirm" class="form-control form-control-lg" plain>
            </div>
            <div class="form-outline mb-2">
                <label class="form-label">Departments</label>
                <select v-model="form.department" class="form-select form-control form-control-lg" plain>
                    <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                </select>
            </div>
            <div class="pt-1 mb-2">
              <button type="submit" class="btn btn-info btn-lg btn-block text-light">Sign up</button>
            </div>
            <p>Already have account? <router-link class="link-info" to="/signin">Sign In here </router-link></p>
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
