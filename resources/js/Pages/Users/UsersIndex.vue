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
      pagination:{},
    }
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser: function(page_url){
      let vm = this;
      page_url = page_url || '/api/user/UsersIndex';
      fetch(page_url)
      .then(res => res.json())
      .then(res => {
        this.user = res.data;
        // this.user = res.data.user,
        this.roles = res.data.roles,
        this.departments = res.data.departments,
        console.log(res.data)
        vm.makePagination(res.meta, res.links);
       console.log([res.meta, res.links])
       
      })
    },
    makePagination:function(meta,links){
      let pagination = {
        currentPage: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      }
      this.pagination = pagination;
     
    },
    // getUser() {
    //   axios.get("/api/user/UsersIndex")
    //   .then(response => {
    //     this.user = response.data.user,
    //     this.roles = response.data.roles,
    //     this.departments = response.data.departments,
    //     console.log(response.data)
    //   })
    //   .catch (error => {console.log(error)})
    // },
    // async deleteUser(id) {
    //   if (confirm("Are you sure you want to delete this user?")) {
    //     try {
    //       const response = await axios.delete(`/api/user/delete/${id}`);
    //       console.log(response.data);
    //       this.getUser();
    //     } catch (error) {
    //       console.log(error);
    //     }
    //   }
    // },
    // async viewUsers(userId) {
    //         const response = await axios.post(`/api/view/${userId}`);
    //         console.log(response.data.message);
    //         location.reload();
    //     }
  
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
                          <h3>Manage Users</h3>
                      </div>
                      <div class="d-grid d-md-flex justify-content-md-end">
                        <router-link to="/UsersCreate" class="btn btn-primary">Add new user</router-link>
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
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-md-table-cell">Role</th>
                            <th class="d-none d-md-table-cell">Department</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="catetbody text-light">
                              <tr v-for="(user, index) in user" :key="index">
                                  <td>{{ index + 1 }}</td>
                                  <td>{{ user.name }}</td>
                                  <td class="d-none d-md-table-cell">{{ user.email }}</td>
                                  <td v-for="role in user.roles" class="d-none d-md-table-cell">
                                    <div class="text-align-center justify-content-center">{{ role.name }}</div>
                                  </td>
                                  <td v-for="department in user.departments" :key="department.id" class="d-none d-md-table-cell">
                                    <div class="text-align-center justify-content-center">{{ department.name }}</div>
                                  </td>
                                  <td>
                                    <div>
                                      <router-link :to="'/UsersShow/' + user.id" class="btn btn-success  me-2"
                                          @click="viewUsers(user.id)"><font-awesome-icon icon="fa-solid fa-book" /></router-link>
                                      <router-link :to="'/UsersUpdate/' + user.id" class="btn btn-primary me-2"><font-awesome-icon icon="fa-solid fa-pen" /></router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteUser(user.id)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
                                    </div>
                                  </td>
                              </tr>
                      </tbody>
                  </table>
                  <nav aria-label="Page navigation example" style="display:flex;justify-content:center;width:100%">
                    <ul class="pagination">
                      <li class="page-item" v-bind:class="[{ disabled: !pagination.prev_page_url }]">
                        <a class="page-link" href="#" @click="getUser(pagination.prev_page_url)" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item disabled"><a class="page-link" href="#">{{ pagination.currentPage }} - {{ pagination.last_page }}</a></li>
                      <li class="page-item" v-bind:class="[{ disabled: !pagination.next_page_url }]">
                        <a class="page-link" href="#"  @click="getUser(pagination.next_page_url)" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
                
              </div> 
          </div>
    </div>
  </div>
  <TheFooter></TheFooter>
</template>