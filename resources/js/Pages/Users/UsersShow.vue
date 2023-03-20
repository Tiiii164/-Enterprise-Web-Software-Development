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
      user: [], // initialize as empty array instead of object
      roles: [],
      departments: [],
    }
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser(id) {
  axios.get(`/api/user/UsersShow/${this.$route.params.id}`)
    .then(response => {
      this.user = [response.data.user], // set user as array with one element
      this.roles = response.data.roles,
      this.departments = response.data.departments,
      console.log(response.data)
    })
    .catch (error => {console.log(error)})
},
    async deleteUser(id) {
      if (confirm("Are you sure you want to delete this user?")) {
        try {
          const response = await axios.delete(`/api/user/delete/${id}`);
          console.log(response.data);
          this.getUser();
        } catch (error) {
          console.log(error);
        }
      }
    },
    async viewUsers(id) {
            const response = await axios.post(`/api/view/${id}`);
            console.log(response.data.message);
            location.reload();
        }
  
  },
}
</script>
<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
      <div class="card border-light">
        <div class="card-header border-light">
          <div class="d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Users Details</h3>
              </div>
              <div class="justify-content-md-end">
                  <router-link to="/UsersIndex" class="btn btn-primary">Back to list</router-link>
              </div>
          </div>
        </div>
        <div class="card-body border-light">
            <div class="container overflow-hidden card-body" v-for="(user, index) in user" :key="index">
              <div class="mb-3 row">
                <div class="form-group">
                  <div class="p-2 border-bottom mb-3"><h5>Name: {{ user.name }}</h5></div>
                  <div class="p-2 border-bottom mb-3"><h5>Email: {{ user.email }}</h5></div>
                  <div class="p-2 border-bottom mb-3" v-for="role in user.roles"><h5>Role: {{ role.name }}</h5></div>
                  <div class="p-2 border-bottom mb-3" v-for="department in user.departments"><h5>Department: {{ department.name }}</h5></div>
                </div>
              </div>
            </div>
        </div> 
        </div>
    </div>
  </div>
  <TheFooter></TheFooter>
</template>
<!-- <script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter
  },
  data() {
    return {
      user: [],
      roles: [],
      departments: [],
    }
  },
  created() {
    this.getUser();
  },
  mounted() { },
  methods: {
    getUser(id) {
  axios.get(`/api/user/UsersShow/${id}`)
    .then(response => {
      this.user = response.data.user,
      this.roles = response.data.roles,
      this.departments = response.data.departments,
      console.log(response.data)
    })
    .catch (error => {console.log(error)})
},
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
            <h3>Staff Submission</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered mx-auto">
          <thead style="text-align:center;align-items:center;justify-content:center">
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Closure Date</th>
              <th>Final Closure Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="catetbody">
                            <tr v-for="(user, index) in user" :key="index">
                                
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td v-for="role in user.roles" >
                                  <td style="text-center;justify-content:center;align-items:center;display:flex">{{ role.name }}</td>
                                </td>
                                <td v-for="department in user.departments" :key="department.id">
                                  <td style="text-center;justify-content:center;align-items:center;display:flex">{{ department.name }}</td>
                                </td>
                                <div>
                                  
                                  <router-link :to="'/UsersUpdate/' + user.id" class="btn btn-primary">Edit</router-link>
                                  <button class="btn btn-danger" @click.prevent="deleteUser(user.id)">Delete</button>
                                </div>
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
</template> -->