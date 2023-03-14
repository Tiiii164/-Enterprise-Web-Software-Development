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
        // role:"",
        // department:"",
        _method: "patch",
      },
      departments: [],   
      roles: [],
    }
  },
  created() {
    this.showUsers();
    this.getUser();
    // this.getDepartments();
  },
  methods: {
    async getUser() {
      axios.get('/api/user/UsersIndex')
      .then(response => {
        this.roles = response.data.roles,
        this.departments = response.data.departments,
        console.log(response.data)
      })
      .catch (error => {console.log(error)})
    },
    async showUsers() {
      try {
        await axios.patch(`/api/user/UsersUpdate/${this.$route.params.id}`)
        .then((response) => {
          const { email, name, role, department } = response.data;
          this.user.email = email;
          this.user.name = name;
          this.user.role = role;
          this.user.department = department;
            });
      } catch (error) {
        console.log(error);
      }
    },
  
    async updateUser() {
      try {
        await axios.patch(`/api/user/UsersUpdate/${this.$route.params.id}`, this.user)
        .then((res) => {
          this.$router.push('/UsersIndex')
            });
      } catch (error) {
        console.log(error);
      }
    },
  //   async getDepartments() {
  //       axios.get('/api/departments/DepartmentsIndex')
  //       .then((response) => { 
  //         this.departments = response.data;
  //   });
  // },
  
  //   async getRoles() {
  //       axios.get('/api/roles/RolesIndex')
  //       .then(response => {
  //         this.roles = response.data;
  //         console.log(response.data);
  //   });
  // }
},  
}
</script>
<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form>
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class=" d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Edit user</h3>
              </div>
              <div class="justify-content-md-end">
                <router-link to="/UsersIndex" class="btn btn-primary">Back to list</router-link>
              </div>
            </div>
            </div>
            <div class="card-body border-light">
                <form @submit.prevent="updateUser">
                    <div class="mb-3 row">
                            <div class="form-group">
                              <label class="col-sm-2 col-form-label"><h4>Email</h4></label>
                              <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" v-model="user.email">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-form-label"><h4>Name</h4></label>
                              <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" v-model="user.name">                              
                              </div>
                            </div>
                            <div class="form-group">  
                                <label class="col-sm-2 col-form-label" for="role"><h4>Role:</h4></label>
                                <div class="col-sm-10">
                                  <select class="form-select form-control" name="role" v-model="user.role">
                                    <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label"><h4>Departments:</h4></label>
                                <div class="col-sm-10">
                                  <select class="form-select form-control" name="department" v-model="user.department">
                                    <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                                  </select>
                                </div>
                              </div>
                            <div class="d-grid d-md-flex justify-content-md-end">
                                <button class="btn btn-primary mt-2" type="submit">Update</button>
                            </div>
                      </div>
                  </form>
            </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
  </template>