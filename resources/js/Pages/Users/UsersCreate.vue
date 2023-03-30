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
          role: '',
          department: '',
    })
    const createUser = async() => {
        axios.post('/api/user/UsersCreate', form)
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
        axios.get('/api/departments/DepartmentsSelect')    
        .then((response) => { 
          this.departments = response.data;
    });
  },
    async getRoles() {
        axios.get('/api/roles/RolesSelect')
        .then(response => {
          this.roles = response.data;
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
    <div class="backgroundsu">
      <form method="POST">
        <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
          <div class="card border-light">
            <div class="card-header border-light">
              <div class="d-grid d-md-flex justify-content-md-between">
                <div class="justify-content-md-start">
                  <h3>Create new User</h3>
                </div>
                <div class="justify-content-md-end">
                  <router-link to="/UsersIndex" class="btn btn-primary catebutton">Back to list</router-link>
                </div>
              </div>
            </div>
              <div class="card-body border-light">
                  <form action="{{route('user.store')}}" method="POST">
                    <div class="mb-3 row">
                        <div class="form-group">
                          <label><strong>Mail</strong></label>
                            <input type="text" name="email" class="form-control" v-model="form.email" placeholder="Enter mail">
                          <label><strong>Name</strong></label>
                            <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter name">
                          <label><strong>Pass</strong></label>
                            <input type="password" name="password" class="form-control" v-model="form.password" placeholder="Enter pass">
                          <label class="form-label" for="role"><strong>Role:</strong></label>
                            <select class="form-select form-control" v-model="form.role">
                              <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                            </select>
                          <label class="form-label"><strong>Departments:</strong></label>
                            <select class="form-select form-control" v-model="form.department">
                              <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                            </select>
                          </div>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <button type="submit" class="btn btn-primary mt-2"  @click.prevent="createUser">Create</button>                          
                    </div>
                  </form>
              </div>
          </div>
        </div>
      </form>
    </div>
      <TheFooter></TheFooter>
  </template>