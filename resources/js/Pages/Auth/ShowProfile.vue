<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
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
          console.log(this.CurrentUser)
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
                        <h3>User Info</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                <div>
                  <p>Name: {{ CurrentUser.name }}</p>
                  <p>Email: {{ CurrentUser.email }}</p>
                  <div v-for="role in roles" :key="role">Role Name: {{ role }}</div>
                </div>
                    <div>
                        <router-link :to="'/UpdateProfile/' + CurrentUser.id" class="btn btn-primary mt-2">Edit</router-link>
                    </div>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>