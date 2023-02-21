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
      role: {}
    }
  },
  methods: {
    async updateRoles() {
      try {
        const response = await axios.patch(`/api/roles/RolesUpdate/${this.$route.params.id}`, this.role)
        .then((res) => {
          this.$router.push('/RolesIndex')
            });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    }
  }
}
</script>
<template>
  <NavBar></NavBar>
    <form >
      <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Roles</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/RolesIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateRoles">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Role Name</strong>
                                <input type="text" name="name" v-model="role.name" class="form-control" placeholder="Enter Role">
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                          </div>
                      </div>
                  </form>
            </div>
        </div>
      </div>
    </form>
  <TheFooter></TheFooter>
  </template>