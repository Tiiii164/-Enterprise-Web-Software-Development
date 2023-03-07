<script>
import { useRouter } from "vue-router"
export default {
  data() {
    return {
      currentUser: {},
      roles: new Set(),
    }
},
  created() {
      this.getCurrentUser()
},
  methods: {
    getCurrentUser() {
      axios.get('/getCurrentUser')
        .then(response => { 
          this.currentUser = response.data
          this.currentUser.roles.forEach(r => {
            this.roles.add(r.name);
          })
        }
      )
      .catch(error => { console.log(error) }
      )
  },
},
  setup() {
    const router = useRouter();
    const handleLogout = () => {
        localStorage.removeItem('Idea_token')
        router.push('/signin')
    }
    return {
      handleLogout,
    } 
  }
};
</script>
<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position:grid;top:0;width:100%;z-index:1">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Idea</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" 
      aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-between" id="navbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown" v-if="roles.has('Admin') || roles.has('Manager')">
          <a class="nav-link dropdown-toggle active nav-item1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Management
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-item">
              <router-link class="nav-link active nav-item1" to="/CategoriesIndex">Category</router-link>
            </li>
            <li class="dropdown-item">
              <router-link class="nav-link active nav-item1" to="TopicsIndex">Submission</router-link>
            </li>
            <li class="dropdown-item">
              <router-link class="nav-link active nav-item1" to="/DepartmentsIndex">Department</router-link>
            </li>
            <li class="dropdown-item">
              <router-link class="nav-link active" to="/RolesIndex">Role</router-link>
            </li>
            <li class="dropdown-item">
              <router-link class="nav-link active" to="/UsersIndex">User</router-link>
            </li>
          </ul>
        </li>
        <li class="nav-item" v-if="roles.has('Admin')|| roles.has('Manager') || roles.has('Staff')">
          <router-link class="nav-link active nav-item1" aria-current="page" to="/StaffSubmission">Staff Submission</router-link>
        </li>
        <li class="nav-item" v-if="roles.has('Admin')|| roles.has('Manager')">
          <router-link class="nav-link active nav-item1" aria-current="page" to="/Statistics">Statistics</router-link>
        </li>
      </ul>
      <div class="d-flex">
        <span class="currentuser" style="font-weight:bold;display:flex;align-items:center;text-align:center"><h6 class="currentuser1">Hello,</h6>  
          <router-link class="text-primary currenthover" style="margin-right:10px;width:auto" to="/ShowProfile">{{ currentUser.name }}!
          </router-link>
          <button type="button" class="btn btn-danger currentuser" style="font-weight:bold;display:flex" @click="handleLogout">Logout</button>
        </span>
      </div>
    </div>
  </div>
</nav>
</template>
