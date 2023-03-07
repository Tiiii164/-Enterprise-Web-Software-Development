<script>
import axios from 'axios';
import { reactive } from "vue";
import { useRouter } from "vue-router"
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter,
},
  data() {
    return {
      user: {
        email:"",
        name: "",
        role:"",
        _method: "patch",
      },
      departments: [],   
      roles: [],
    }
  },
  created() {
    this.showUsers()
  },
  methods: {
    async showUsers() {
      try {
        const response = await axios.patch(`/api/users/UsersUpdate/${this.$route.params.id}`)
        .then((res) => {
          const {email} = res.data
          this.user.email = email
          const {name} = res.data
          this.user.name = name
          const {role} = res.data
          this.user.role = role
            });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    },
  
    async updateUser() {
      try {
        const response = await axios.patch(`/api/users/UsersUpdate/${this.$route.params.id}`, this.user)
        .then((res) => {
          this.$router.push('/UsersIndex')
            });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    },
    async getDepartments() {
        axios.get('/api/departments/')    
        .then((response) => { 
          this.departments = response.data;
    });
  },
  
    async getRoles() {
        axios.get('/api/roles/RolesIndex')
        .then(response => {
          this.roles = response.data;
          console.log(response.data);
    });
  }
},
mounted() {
    this.getRoles();
    this.getDepartments();
  },  
}
</script>
<template>
  <NavBar></NavBar>
    <form >
      <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit user</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/UsersIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateUser">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                  <strong>Mail</strong>
                                  <input type="text" name="email" class="form-control" v-model="user.email">
                                  <strong>Name</strong>
                                  <input type="text" name="name" class="form-control" v-model="user.name">
                                  <label class="form-label" for="role">Role:</label>
                                  <select class="form-select form-control" v-model="user.role">
                                    <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                  </select>
                                  <label class="form-label">Departments: </label>
                                  <!-- <select class="form-select form-control" v-model="form.department_id">
                                      <option v-for="data in departments" :value="data.id">{{ data.name }}</option>
                                  </select>  -->
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary mt-2" type="submit">Update</button>
                            </div>
                          </div>
                      </div>
                  </form>
            </div>
        </div>
      </div>
    </form>
  <TheFooter></TheFooter>
  </template> -->
  