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
      department: {}
    }
  },
  methods: {
    async updateDepartments() {
      try {
        const response = await axios.patch(`/api/departments/DepartmentsUpdate/${this.$route.params.id}`, this.department)
        .then((res) => {
          this.$router.push('/DepartmentsIndex')
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
  <NavBar></NavBar>
    <form >
      <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Departments</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/DepartmentsIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateDepartments">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Department Name</strong>
                                <input type="text" name="name" v-model="department.name" class="form-control" placeholder="Enter Department">
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                          </div>
                      </div>
                  </form>
            </div>
        </div>
      </div>
    </form>
  <TheFooter></TheFooter>
  </template>