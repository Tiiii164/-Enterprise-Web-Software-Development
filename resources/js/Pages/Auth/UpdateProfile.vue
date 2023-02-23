<script>
export default {
  data() {
    return {
      name: '',
      email: '',
    };
  },
  created() {
    axios.get('/api/auth/ShowProfile')
      .then(response => {
        this.name = response.data.user.name;
        this.email = response.data.user.email;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    updateProfile() {
      axios.put('/auth/api/UpdateProfile', {
        name: this.name,
        email: this.email,
      })
      .then(response => {
        console.log(response.data);
      })
      .catch(error => {
        console.log(error);
      });
    },
  },
};
</script>

<template>
  <div>
    <h1>Update Profile</h1>
    <form @submit.prevent="updateProfile">
      <label for="name">Name:</label>
      <input type="text" v-model="name">
      <br>
      <label for="email">Email:</label>
      <input type="email" v-model="email">
      <br>
      <button type="submit">Update</button>
    </form>
  </div>
</template>