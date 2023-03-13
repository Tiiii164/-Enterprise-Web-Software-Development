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
    <form >
      <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
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
                      <div class="col-md-6 catecenter" >
                            <div class="form-group">
                                  <strong>Mail</strong>
                                  <input type="text" name="email" class="form-control" v-model="user.email">
                                  <strong>Name</strong>
                                  <input type="text" name="name" class="form-control" v-model="user.name">
                                  <label class="form-label" for="role">Role:</label>
                                  <select class="form-select form-control" name="role" v-model="user.role">
                                    <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                  </select>
                                  <label class="form-label">Departments: </label>
                                  <select class="form-select form-control" name="department" v-model="user.department">
                                    <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                                  </select>
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
       <div>
        <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
    </div> 
    </form>
  <TheFooter></TheFooter>
  </template>