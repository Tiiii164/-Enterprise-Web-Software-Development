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
      roles: new Set(),
    }
},
  created() {
      this.getCurrentUser();
},
  methods: {
    getCurrentUser() {
      axios.get('/api/ShowProfile')
        .then(response => { 
          this.CurrentUser = response.data
          // console.log(this.CurrentUser)
          this.CurrentUser.roles.forEach(r => {
            this.roles.add(r.name);
          })
        }
      )
      .catch(error => { console.log(error) }
      )
    }
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
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="role in roles" :key="role">
                                <td>{{ CurrentUser.name }} 
                                  <span>
                                  <router-link :to="'/UpdateProfile/' + CurrentUser.id" 
                                  class="btn btn-primary mt-2">Edit</router-link>
                                  </span>
                                </td>
                                <td>{{ CurrentUser.email }}</td>
                                <td>{{ role }}</td>
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