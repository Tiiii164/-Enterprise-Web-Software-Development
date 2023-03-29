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
  <div class="backgroundsu">
    <form>
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class=" d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Edit Roles</h3>
              </div>
              <div class="justify-content-md-end">
                <router-link to="/RolesIndex" class="btn btn-primary">Back to list</router-link>
              </div>
            </div>
          </div>
          <div class="card-body border-light">
            <form @submit.prevent="updateRoles">
              <div class="mb-3 row">
                <label class="col-sm-12 col-form-label"><h4>Role Name</h4></label>
                <div class="col-sm-12">
                  <input type="text" name="name" v-model="role.name" class="form-control">
                </div>
              </div>
              <div class="d-grid d-md-flex justify-content-md-end">
                <button class="btn btn-primary mt-2" type="submit">Update</button>
              </div>
            </form>
            </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
  </template>