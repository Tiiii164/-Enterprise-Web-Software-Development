<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Idea</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/StaffSubmission">Staff Submission</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/Login">Log In</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/Register">Register</router-link>        
        </li>
        <li v-if="auth=='loggedin'" class="nav-item">
          <router-link class="nav-link" to="/StaffProfile">Profile</router-link>
        </li>
        <li v-if="auth=='loggedin'" class="nav-item">
          <router-link class="nav-link" href="">Logout</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<script>
    export default {
        data() {
            return {
                auth: '',
                user: '',
            }
        },
        methods:{
              logout() {
                  localStorage.removeItem('usertoken')
              }
            },
        }
</script>