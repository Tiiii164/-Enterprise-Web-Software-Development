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
      users: [],
      roles: [],
      departments: [],
    }
  },
  created() {
    this.getUser();
    this.getRole();
    this.getDepartment();
  },
  methods: {
    async getUser() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getRole() {
      try {
        const response = await axios.get('/api/roles');
        this.roles = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getDepartment() {
      try {
        const response = await axios.get('/api/departments');
        this.departments = response.data;
      } catch (error) {
        console.log(error);
      }
    },
  }
}
</script>
<template>
    <NavBar></NavBar>
    <div class="container text-center mt-5">
        <div class="row ">
            <div class="col-sm-6 .col-md-12 .col-lg-12 border">
                <h4>Departments</h4>
                <div v-for="department in departments" :key="department">
                    <div class="d-flex justify-content-between">
                        <div>{{ department.name }}</div>
                        <div>{{ department.users_count }}</div>                     
                    </div>
                    <hr class="hr" />
                </div>
            </div>
            <div class="col-sm-6 .col-md-12 .col-lg-12 border">
                <h4>Roles</h4>
                <div v-for="role in roles" :key="role">
                    <div class="d-flex justify-content-between">
                        <div>{{ role.name }}</div>
                        <div>{{ role.users_count }}</div>
                    </div>
                    <hr class="hr" />
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6 .col-md-12 .col-lg-12 border">
                <h4>Users</h4>
                <div v-for="user in users" :key="user">
                    <div class="d-flex justify-content-between">
                        <div>{{ user.name }}</div>
                        <div>{{ user.ideas_count }}</div>                     
                    </div>
                    <hr class="hr" />
                </div>
            </div>
            <div class="col-sm-6 .col-md-12 .col-lg-12 border">
            </div>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>