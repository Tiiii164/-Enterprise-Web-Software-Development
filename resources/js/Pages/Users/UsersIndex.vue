<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter
  },
  data() {
    return {
      users: [],
      roles: new Set(),
      users:'',
      
    }
  },
  created() {
    this.getUser();
  },

  methods: {
    async getUser() {
      try {
        const response = await axios.get('/api/UsersIndex');
        this.users = response.data
        this.users.roles.forEach(r => { this.roles.add(r.name);})
        console.log(this.users)
         
      } catch (error) {
        console.log(error);
      }
    },
    async deleteUser(id) {
      if (confirm("Are you sure you want to delete this user?")) {
        try {
          const response = await axios.delete(`/api/users/delete/${id}`);
          console.log(response.data);
          this.getUser();
        } catch (error) {
          console.log(error);
        }
      }
    }
  
  },
  
}
</script>

<template>
  <NavBar></NavBar>
  <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Manage users</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/UsersCreate" class="btn btn-primary float-end">Add new user</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(role, index) in roles" :key="role">
                                <td>{{ index + 1 }}</td>
                                <td>{{ users.email }}</td>
                                <td>{{ users.name }}</td>
                                <td>{{ role }}</td>
                              
                                
                                <div>
                                      <router-link :to="'/UsersUpdate/' + user.id" class="btn btn-primary">Edit</router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteUser(user.id)">Delete</button>
                                    </div>
                            </tr>
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>