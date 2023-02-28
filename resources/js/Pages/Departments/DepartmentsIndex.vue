<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter
  },
  data() {
    return {
      departments: []
    }
  },
  created() {
    this.getDepartment();
  },
  mounted() {},
  methods: {
    async getDepartment() {
      try {
        const response = await axios.get('/api/departments/DepartmentsIndex');
        this.departments = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteDepartment(id) {
      if (confirm("Are you sure you want to delete this department?")) {
        try {
          const response = await axios.delete(`/api/departments/delete/${id}`);
          console.log(response.data);
          this.getDepartment();
        } catch (error) {
          console.log(error);
        }
      }
    }
  },
}
</script>

<template>
  <NavBar></NavBar>
  <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Manage Departments</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/DepartmentsCreate" class="btn btn-primary float-end">Add new Departments</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(department, index) in departments" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ department.name }}</td>
                                <td>
                                    <div>
                                      <router-link :to="'/DepartmentsUpdate/' + department.id" class="btn btn-primary">Edit</router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteDepartment(department.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>