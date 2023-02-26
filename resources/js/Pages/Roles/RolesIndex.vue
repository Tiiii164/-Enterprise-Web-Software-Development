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
      roles: []
    }
  },
  created() {
    this.getRole();
  },
  methods: {
    async getRole() {
      try {
        const response = await axios.get('/api/roles/RolesIndex');
        this.roles = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteRole(id) {
      if (confirm("Are you sure you want to delete this role?")) {
        try {
          const response = await axios.delete(`/api/roles/delete/${id}`);
          console.log(response.data);
          this.getRole();
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
                        <h3>Manage Roles</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/RolesCreate" class="btn btn-primary float-end">
                          Add new roles</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(role, index) in roles" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ role.name }}</td>
                                <td>
                                    <div>
                                      <router-link :to="'/RolesUpdate/' + role.id" class="btn btn-primary">Edit</router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteRole(role.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>