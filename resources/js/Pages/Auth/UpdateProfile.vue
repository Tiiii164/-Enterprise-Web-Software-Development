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
      profile: {
        name: "",
        _method: "patch",
      },
      roles: [],
      departments: [],   
    }
  },
  created() {
    this.getUser();
    this.showProfileInfo()
  },
  methods: {
    async getUser() {
      axios.get('/api/user/UsersSelect')
      .then(response => {
        this.roles = response.data.roles,
        this.departments = response.data.departments
      })
      .catch (error => {console.log(error)})
    },
    async showProfileInfo() {
      try {
        const response = await axios.get(`/api/Profile/${this.$route.params.id}`)
        const { name, roles, departments } = response.data;
        this.profile.name = name
        this.profile.role = roles[0].id;
        this.profile.department = departments[0].id;
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    },
    async updateProfile() {
      try {
        const response = 
        await axios.patch(`/api/UpdateProfile/${this.$route.params.id}`, this.profile)
        .then((res) => {
          alert("Updated Successfully.")
          this.$router.push('/ShowProfile')
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
  <div class="backgroundsu">
    <form>
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class="d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Edit Profile</h3>
              </div>
              <div class="justify-content-md-end">
                <router-link to="/ShowProfile" class="btn btn-primary">Back to Profile Page</router-link>
              </div>
            </div>
          </div>
          <div class="card-body border-light">
            <form @submit.prevent="updateProfile">
              <div class="mb-3 row">
                <div class="form-group">
                  <label class="col-sm-12 col-form-label"><h4>Your Name</h4></label>
                  <div class="col-sm-12">
                    <input type="text" name="email" v-model="profile.name" class="form-control">                  
                  </div>
                </div>
                <div class="d-grid d-md-flex justify-content-md-end">
                  <button class="btn btn-primary mt-2" type="submit">Update</button>
                </div>
              </div>
            </form>
            </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
</template>