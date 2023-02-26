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
    }
  },
  mounted() {
    this.showProfileInfo()
  },
  methods: {
    async showProfileInfo() {
      try {
        const response = await axios.patch(`/api/UpdateProfile/${this.$route.params.id}`)
        .then((res) => {
          const {name} = res.data
          this.profile.name = name
            });
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
          alert("Update Name Successfully.")
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
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/ShowProfile" class="btn btn-primary float-end">Back to Profile Page</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateProfile">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Your name:</strong>
                                <input type="text" name="email" v-model="profile.name" class="form-control">
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
  <TheFooter></TheFooter>
</template>