<script>
export default {
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
      error: '',
      success: '',
    }
  },
  methods: {
    changePassword() {
      if (this.newPassword !== this.confirmPassword) {
        this.error = 'New password and confirm password do not match.';
        return;
      }
      
      axios.post('/api/ChangPassword', {
        current_password: this.currentPassword,
        new_password: this.newPassword,
        confirm_password: this.confirmPassword,
      })
      .then(response => {
        this.success = response.data.message;
        this.error = '';
        this.currentPassword = '';
        this.newPassword = '';
        this.confirmPassword = '';
        if(confirm('Do you want to sign in again?'))
        {
            this.$router.push('/signin')
        }
      })
      .catch(error => {
        this.success = '';
        console.log(error);
        if (error.response.status === 422) {
          this.error = error.response.data.errors.current_password[0];
        } else {
          this.error = 'An error occurred while changing password. Please try again later.';
        }
      });
    },
  },
};
</script>  

<template>
    <div>
      <h1>Change Password</h1>
      <div v-if="error" class="alert alert-danger">{{ error }}</div>
      <div v-if="success" class="alert alert-success">{{ success }}</div>
      <form>
        <div class="form-group">
          <label for="currentPassword">Current Password</label>
          <input type="password" class="form-control" v-model="currentPassword" id="currentPassword">
        </div>
        <div class="form-group">
          <label for="newPassword">New Password</label>
          <input type="password" class="form-control" v-model="newPassword" id="newPassword">
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" v-model="confirmPassword" id="confirmPassword">
        </div>
        <button type="button" class="btn btn-primary" @click="changePassword">Change Password</button>
        <div>
              <router-link :to="'/ShowProfile'" 
              class="btn btn-primary mt-2">Back To User Page</router-link>
            </div>
      </form>
    </div>
  </template>