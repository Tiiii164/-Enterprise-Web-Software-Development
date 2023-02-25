<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import axios from 'axios';
export default {
  components: {
    NavBar,
    TheFooter,
  },
  data() {
    return {
      department: {
        name:"",
        _method: "patch",
      }
    }
  },
  mounted() {
    this.showDepartments()
  },
  methods: {
    async showDepartments() {
      try {
        const response = await axios.patch(`/api/departments/DepartmentsUpdate/${this.$route.params.id}`)
        .then((res) => {
          const {name} = res.data
          this.department.name = name
        });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    },
    async updateDepartments() {
        await axios.patch(`/api/departments/DepartmentsUpdate/${this.$route.params.id}`, this.department)
        .then((res) => {
          this.$router.push('/DepartmentsIndex')
        }).catch (error => {
          console.log(error);
      })
    }
  },
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
                                <input type="text" name="name" v-model="department.name" class="form-control">
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary mt-2" type="submit">Update</button>
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