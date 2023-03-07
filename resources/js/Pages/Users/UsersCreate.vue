<script>
import axios from 'axios';
import { reactive } from "vue";
import { useRouter } from "vue-router"
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar, TheFooter
  },
  data() {
    return {
      departments: [],   
      roles: [], 
  }
},
  setup() {
    const router = useRouter()
    const form = reactive ({
          name: '',
          email: '',
          password: '',
          department_id: '',
          role: '',
    })
    const createUser = async() => {
        axios.post('/api/users/UsersCreate', form)
        .then(response => {
        console.log(response);
        router.push('/UsersIndex');
        })
        .catch(error => {
          console.log(error)
        })
    } 
    return {
      form,
      createUser,
    }
  },
  methods: {
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
  }, 
},
  mounted() {
    this.getRoles();
    this.getDepartments();
  },  
}
</script>
<template>
    <NavBar></NavBar>
      <form method="POST">
        <div class="container">
          <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-6">
                          <h3>Create new User</h3>
                      </div>
                      <div class="col-md-6">
                          <router-link to="/UsersIndex" class="btn btn-primary float-end">Back to list</router-link>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <form action="{{route('user.store')}}" method="POST">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <strong>Mail</strong>
                                  <input type="text" name="email" class="form-control" v-model="form.email" placeholder="Enter mail">
                                  <strong>Name</strong>
                                  <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter name">
                                  <strong>Pass</strong>
                                  <input type="password" name="password" class="form-control" v-model="form.password" placeholder="Enter pass">
                                  <label class="form-label" for="role">Role:</label>
                                  <select class="form-select form-control" v-model="form.role">
                                    <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                  </select>
                                  <label class="form-label">Departments: </label>
                                  <!-- <select class="form-select form-control" v-model="form.department_id">
                                      <option v-for="data in departments" :value="data.id">{{ data.name }}</option>
                                  </select> -->
                              </div>
                              <button type="submit" class="btn btn-primary mt-2"  @click.prevent="createUser">Create</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </form>
      <TheFooter></TheFooter>
  </template>