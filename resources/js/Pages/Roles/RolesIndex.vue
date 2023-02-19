<script>
export default {
  data() {
    return {
      role: []
    }
  },
  methods: {
    async getRole() {
      try {
        const response = await axios.get(`/api/roles/RolesIndex`);
        this.role = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    // async editRole() {
    //   this.$router.push(`/roles/${this.$route.params.id}/edit`);
    // },
    async deleteRole() {
      if (confirm("Are you sure you want to delete this product?")) {
        try {
          const response = await axios.delete(`/api/roles/${this.$route.params.id}`);
          // handle success
          console.log(response.data);
          this.$router.push('/RolesIndex');
        } catch (error) {
          // handle error
          console.error(error);
        }
      }
    }
  },
  created() {
    this.getRole();
  }
}
</script>

<template>
      <router-link to="/RolesCreate">Create Role</router-link>
      <div v-for="role in roles" :key="role.id">
        {{ role.id }}
        {{ role.name }}
        <router-link :to="'/roles/edit/' + role.id" 
            class="btn btn-primary">Edit</router-link>
        <button class="btn btn-danger" @click.prevent="deleteRole(roles.id)">
            Delete</button>
      </div>
</template>