<script>
import { useRouter } from "vue-router"
export default {
  data() {
    return {
      current_user: {},
      roles: new Set(),
      permissions: new Set(),
    }
  },
  created() {
      console.log(window.user);
      console.log(window.user_roles);
      console.log(window.user_permissions);     
      
      this.current_user = window.user

      window.user_roles.forEach(r => {
        this.roles.add(r.name);
      });

      window.user_permissions.forEach(p => {
        this.permissions.add(p.name);
      });
    },
  setup() {
    const router = useRouter();
    const handleLogout = () => {
        localStorage.removeItem('Idea_token')
        router.push('/login')
    }
    return {
      handleLogout,
    }
  }
}
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Idea</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-between" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/">Home</router-link>
        </li>
        <li class="nav-item" v-if="roles.has('Staff')">
          <router-link class="nav-link active" aria-current="page" to="/StaffSubmission">Staff Submission</router-link>
        </li>
        <li class="nav-item" v-if="roles.has('Admin')">
          <router-link class="nav-link active" aria-current="page" to="/RolesIndex">Roles</router-link>
        </li>
      </ul>
      <div class="d-flex">
        <span class="capitalize">Hello, {{ current_user.name }} 
            <button type="button" class="btn btn-outline-primary btn-sm" @click="handleLogout">Logout</button>
        </span>
      </div>
    </div>
  </div>
</nav>
</template>