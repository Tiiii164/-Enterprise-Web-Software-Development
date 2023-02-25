<script>
export default {
  data() {
    return {
      profile: {}
    };
  },
  methods: {
    async updateProfile() {
      try {
        const response = 
        await axios.patch(`/api/UpdateProfile/${this.$route.params.id}`, this.profile)
        .then((res) => {
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
  <div>
    <h1>Update Profile</h1>
    <form @submit.prevent="updateProfile">
      <label for="name">Name:</label>
      <input type="text" v-model="profile.name">
      <br>
      <label for="email">Email:</label>
      <input type="email" v-model="profile.email">
      <br>
      <button type="submit">Update</button>
    </form>
  </div>
</template>