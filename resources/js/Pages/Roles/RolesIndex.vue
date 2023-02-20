<script>
export default {
  data() {
    return {
      roles: []
    }
  },
  created() {
    this.getRole();
  },
  mounted() {},
  methods: {
    async getRole() {
      try {
        const response = await axios.get('/api/roles/RolesIndex');
        this.roles = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteRole(id) {
      if (confirm("Are you sure you want to delete this role?")) {
        try {
          const response = await axios.delete(`/api/roles/delete/${id}`);
          console.log(response.data);
          this.getRole();
        } catch (error) {
          console.log(error);
        }
      }
    }
  },
}
</script>

<template>
  <div>
    <router-link to="/RolesCreate">Create Role</router-link>
    <div v-for="(role, index) in roles" :key="index">
      {{ role.id }}
      {{ role.name }}
      <router-link :to="'/RolesUpdate/' + role.id" class="btn btn-primary">Edit</router-link>
      <button class="btn btn-danger" @click.prevent="deleteRole(role.id)">Delete</button>
    </div>
  </div>
</template>