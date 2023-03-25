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
      
      axios.post('/api/ChangePassword', {
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
<NavBar></NavBar>
  <div class="backgroundsu">
    <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
      <div class="card border-light">
        <div class="card-header border-light">
          <div class="d-grid d-md-flex justify-content-md-between">
            <div class="justify-content-md-start">
              <h3>Change Password</h3>
            </div>
            <div class="justify-content-md-end">
              <div v-if="error" class="alert alert-danger">{{ error }}</div>
              <div v-if="success" class="alert alert-success">{{ success }}</div>            
            </div>
          </div>
        </div>
        <div class="card-body border-light">
          <form>
            <div class="mb-3 row">
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
            <div class="d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start mt-2">
                <button type="button" class="btn btn-primary" @click="changePassword">Change Password</button>
              </div>
              <div class="justify-content-md-end mt-2">
                <router-link :to="'/ShowProfile'" 
                class="btn btn-primary">Back To User Page</router-link>
              </div>
            </div>
            </div>
      </form>
        </div>
      </div>
    </div>
      <!--
       -->
  </div>
<TheFooter></TheFooter>
  </template>