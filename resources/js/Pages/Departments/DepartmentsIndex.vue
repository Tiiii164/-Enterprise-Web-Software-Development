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
  <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 catecenter">
                        <h3>Manage Departments</h3>
                    </div>
                    <div class="col-md-6 catecenter">
                        <router-link to="/DepartmentsCreate" class="btn btn-primary catebutton">Add new Departments</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered mx-auto">
                    <thead style="text-align:center;align-items:center;justify-content:center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="catetbody">
                            <tr v-for="(department, index) in departments" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ department.name }}</td>
                                <td>
                                    <div>
                                      <router-link :to="'/DepartmentsUpdate/' + departments.id" class="btn btn-primary">Edit</router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteDepartment(departments.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
    <div>
      <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
  </div>
  <TheFooter></TheFooter>
</template>