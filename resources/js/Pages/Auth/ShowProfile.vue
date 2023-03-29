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
      departments: new Set(),
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
          this.CurrentUser.roles.forEach(r => {
            this.roles.add(r.name);
          })
          this.CurrentUser.departments.forEach(d => {
            this.departments.add(d.name);
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
  <div class="backgroundsu">
    <div class="container text-center mt-5 position-absolute start-50 translate-middle-x">
      <div class="card border-light">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm mx-auto border-light">
                  <thead class="text-light text-align-center justify-content-center">
                        <tr>
                            <th>Name:</th>
                            <th>Email:</th>
                            <th>Role:</th>
                            <th>Departments:</th>
                        </tr>
                    </thead>
                    <tbody class="catetbody text-light">
                            <tr>
                                <td>{{ CurrentUser.name }} 
                                  <span class="ms-2">
                                    <router-link :to="'/Profile/' + CurrentUser.id">
                                      <font-awesome-icon icon="fa-solid fa-pen" />
                                    </router-link>
                                  </span>
                                </td>
                                <td>{{ CurrentUser.email }}</td>
                                <td v-for="role in roles" :key="role">{{ role }}</td>
                                <td v-for="department in departments" :key="department">{{ department }}</td>
                            </tr>
                    </tbody>
                </table> 
              </div>
            </div>
            <div class="mb-4">
              <router-link :to="'/ChangePassword'" 
              class="btn btn-primary mt-2">Change Password</router-link>
            </div>
        </div>
    </div>
  </div>
<TheFooter></TheFooter>
</template>