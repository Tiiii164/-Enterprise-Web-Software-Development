<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
      NavBar,
      TheFooter,
    },
  data() {
    return {
      CurrentUser: {},
      roles: new Set (),
      departments: [
        'name'
      ],
    }
},
  mounted() {
    this.getCurrentUser();
    this.getDepartments();
},
  methods: {
    getCurrentUser() {
      axios.get('/api/ShowProfile')
        .then(response => { 
          this.CurrentUser = response.data
          console.log(response.data);
          this.CurrentUser.roles.forEach(r => {
            this.roles.add(r.name);
          })
        }
      )
      .catch(error => { console.log(error) }
      )
    },
    getDepartments() {
      axios.get('/api/departments')
        .then(response => {
          this.departments = response.data
          console.log(response.data)
      })
    },
  }
};
</script>
<template>
  <NavBar></NavBar>
  <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>User's Information</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Email:</th>
                            <th>Role:</th>
                            <th>Department:</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="role in roles" :key="role.id">
                                <td>{{ CurrentUser.name }} 
                                  <span>
                                  <router-link :to="'/UpdateProfile/' + CurrentUser.id" 
                                  class="btn btn-primary mt-2">Edit</router-link>
                                  </span>
                                </td>
                                <td>{{ CurrentUser.email }}</td>
                                <td >
                                  <td>{{ role }}</td>
                                </td>
                                <td>{{ CurrentUser.department_id }}</td>
                                <!-- <td v-for="department in departments" :key="department.id">
                                  <td>{{ department }}</td>
                                </td> -->
                            </tr>
                    </tbody>
                </table> 
            </div>
            <div>
              <router-link :to="'/ChangePassword'" 
              class="btn btn-primary mt-2">Change Password</router-link>
            </div>
        </div>
    </div>
  <TheFooter></TheFooter>
</template>