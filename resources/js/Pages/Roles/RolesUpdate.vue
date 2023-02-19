<script>
export default {
  data() {
    return {
      role: []
    };
  },
  created() {
    // Call API to get product details
    axios.get(`/api/roles/RolesIndex`)
      .then(response => {
        this.role = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    updateRoles() {
      // Call API to update product
      axios.put(`/api/roles/RolesUpdate/${this.$route.params.id}`, this.role)
        .then(() => {
          // Redirect to show page
          this.$router.push(`RolesIndex`);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
}
</script>
<template>
    <form @submit.prevent="updateRoles">
            <label>Role Name:</label>
            <input type="text" class="form-control" v-model="role.name">
        <div class="form-group">
          <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </template>
