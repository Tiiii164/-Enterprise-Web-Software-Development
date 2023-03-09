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
      role: {
        name: "",
        _method: "patch",
      }
    }
  },
  created() {
    this.showRoles()
  },
  methods: {
    async showRoles() {
      try {
        await axios.patch(`/api/roles/RolesUpdate/${this.$route.params.id}`)
        .then((res) => {
          const {name} = res.data
          this.role.name = name
        });
      } catch (error) {
        console.log(error);
      }
    },
    async updateRoles() {
      try {
        await axios.patch(`/api/roles/RolesUpdate/${this.$route.params.id}`, this.role)
        .then((res) => {
          alert("Updated Successfully.")
          this.$router.push('/RolesIndex')
            });
      } catch (error) {
        console.log(error);
      }
    }
  }
}
</script>
<template>
  <NavBar></NavBar>
    <form>
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
                                <input type="text" name="name" v-model="role.name" class="form-control">
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary mt-2" type="submit">Update</button>
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