<script>
import axios from 'axios';
import DropdownRole from '@/Components/DropdownRole.vue';
import { ref, reactive } from "vue";
import { useRouter } from "vue-router"
    export default {
        data() {
    return {
      roles: [],
      selectedRole: null,
    };
  },
  mounted() {
    axios.get('/api/roles/RolesIndex').then(response => {
      this.roles = response.data;
    });
  },
  components: {
    DropdownRole,
  },
    setup() {
        const errors = ref()
        const router = useRouter();
        const form = reactive({
            email: '',
            name: '',
            password: '',
            
        })
        
        const createUser = async() => {
      try {
        const response = await axios.post('/api/users/UsersCreate', form);
        console.log(response.data);
        router.push('/UsersIndex');
      } catch (error) {
        console.error(error);
      }
    }
    return {
        form,
        createUser,
    }
    }
}
</script>
<template>
    <NavBar></NavBar>
      <form @submit.prevent="createUser" method="POST">
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
                                  <dropdown-role></dropdown-role>
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