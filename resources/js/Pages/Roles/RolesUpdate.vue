<script>
export default {
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
    <form @submit.prevent="updateRoles">
            <label>Role Name:</label>
            <input type="text" class="form-control" v-model="role.name">
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
  </template>
