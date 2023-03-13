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
      user: [],
      roles: [],
      departments: [],
    }
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      axios.get('/api/user/UsersIndex')
      .then(response => {
        this.user = response.data.user,
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
                        <h3>Manage users</h3>
                    </div>
                    <div class="col-md-6 catecenter">
                        <router-link to="/UsersCreate" class="btn btn-primary float-end">Add new user</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered mx-auto">
                <thead style="text-align:center;align-items:center;justify-content:center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="catetbody">
                            <tr v-for="(user, index) in user" :key="index">
                                <td>{{ index + 1 }}</td>
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
</template>