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
      departments: [],
      roles: [],
    }
  },
  created() {
    this.getRole();
    this.getDepartment();
  },
  methods: {
    async getDepartment() {
      try {
        const response = await axios.get('/api/departments/DepartmentsIndex');
        this.departments = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getRole() {
      try {
        const response = await axios.get('/api/roles/RolesIndex');
        this.roles = response.data;
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
        <div class="row">
            <div class="col">
                <h4>Departments</h4>
                <div v-for="department in departments" :key="department">
                    <div class="d-flex justify-content-between">
                        <div>{{ department.name }}</div>
                        <div v-if="departments.length">{{departments.length}}</div>
                    </div>
                    <hr class="hr" />
                </div>
            </div>
            <div class="vr"></div>
            <div class="col">
                <h4>Roles</h4>
                <div v-for="role in roles" :key="role">
                    <div class="d-flex justify-content-between">
                        <div>{{ role.name }}</div>
                        <div>1</div>
                    </div>
                    <hr class="hr" />
                </div>
            </div>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>