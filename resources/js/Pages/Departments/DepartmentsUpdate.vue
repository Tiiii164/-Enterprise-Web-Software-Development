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
      department: {
        name: "",
        _method: "patch",
      }
    }
  },
  created() {
    this.showDepartments()
  },
  methods: {
    async showDepartments() {
      try {
        await axios.patch(`/api/departments/DepartmentsUpdate/${this.$route.params.id}`)
        .then((res) => {
          const {name} = res.data
          this.department.name = name
        });
      } catch (error) {
        console.log(error);
      }
    },
    async updateDepartments() {
      try {
        await axios.patch(`/api/departments/DepartmentsUpdate/${this.$route.params.id}`, this.department)
        .then((res) => {
          alert("Updated Successfully.")
          this.$router.push('/DepartmentsIndex')
            });
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
      <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                  <div class="col-md-6 catecenter" >
                        <h3>Edit Departments</h3>
                    </div>
                    <div class="col-md-6 catecenter" >
                        <router-link to="/DepartmentsIndex" class="btn btn-primary catebutton">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateDepartments">
                    <div class="row">
                      <div class="col-md-6 catecenter" >
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
      <div>
        <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
    </div>
    </form>
  <TheFooter></TheFooter>
  </template>