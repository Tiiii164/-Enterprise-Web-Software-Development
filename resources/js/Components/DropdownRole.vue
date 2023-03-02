<template>
    <div>
      <label for="role">Role:</label>
      <select name="role" v-model="selectedRole">
        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
      </select>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        roles: [],
        selectedRole: null,
      };
    },
    mounted() {
      axios.get('/api/roles/RolesIndex').then(response => {
        this.roles = response.data;
      });
    },
  };
  </script>  