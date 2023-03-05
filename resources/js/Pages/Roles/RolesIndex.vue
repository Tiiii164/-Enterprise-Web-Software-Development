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
  <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
    <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 catecenter">
                        <h3>Manage Roles</h3>
                    </div>
                    <div class="col-md-6 catecenter">
                        <router-link to="/RolesCreate" class="btn btn-primary catebutton">Add new roles</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered mx-auto">
                <thead style="text-align:center;align-items:center;justify-content:center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="catetbody">
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
    <div>
      <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
  </div>
  <TheFooter></TheFooter>
</template>