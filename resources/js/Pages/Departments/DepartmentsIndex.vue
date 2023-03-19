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
  <div class="backgroundsu">
    <div class="container text-center mt-5 position-absolute start-50 translate-middle-x text-light">
          <div class="card border-light">
            <div class="card-header border-light">
                <div class="d-grid d-md-flex justify-content-md-between m-2">
                    <div class="d-grid d-md-flex justify-content-md-start">
                          <h3>Manage Departments</h3>
                      </div>
                      <div class="d-grid d-md-flex justify-content-md-end">
                        <router-link to="/DepartmentsCreate" class="btn btn-primary">Add new Departments</router-link>
                      </div>
                  </div>
              </div>
              <div class="card-body border-light">
                <div class="table-responsive">
                  <table class="table table-sm mx-auto border-light">
                      <thead class="text-light text-align-center justify-content-center">
                          <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="catetbody text-light">
                              <tr v-for="(department, index) in departments" :key="index">
                                  <td>{{ index + 1 }}</td>
                                  <td>{{ department.name }}</td>
                                  <td>
                                    <div class="d-grid d-md-flex justify-content-md-center">
                                      <router-link :to="'/DepartmentsUpdate/' + department.id" class="btn btn-primary me-md-2"><font-awesome-icon icon="fa-solid fa-pen" /></router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteDepartment(departments.id)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
                                    </div>
                                  </td>
                              </tr>
                      </tbody>
                  </table> 
                </div>
              </div> 
          </div>
      </div>
  </div>
  <TheFooter></TheFooter>
</template>