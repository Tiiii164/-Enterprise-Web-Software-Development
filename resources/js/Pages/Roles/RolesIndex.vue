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
      roles: [],
      pagination:{},
    }
  },
  created() {
    this.getRole();
  },
  methods: {
    getRole: function(page_url){
      let vm = this;
      page_url = page_url || '/api/roles/RolesIndex';
      fetch(page_url)
      .then(res => res.json())
      .then(res => {
        this.roles = res.data;
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
    // async getRole() {
    //   try {
    //     const response = await axios.get('/api/roles/RolesIndex');
    //     this.roles = response.data;
    //   } catch (error) {
    //     console.log(error);
    //   }
    // },
    async deleteRole(id) {
      if (confirm("Are you sure you want to delete this role?")) {
        try {
          const response = await axios.delete(`/api/roles/delete/${id}`);
          console.log(response.data);
          this.getRole();
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
                        <h3>Manage Roles</h3>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <router-link to="/RolesCreate" class="btn btn-primary">Add new roles</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
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
                            <tr v-for="(role, index) in roles" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ role.name }}</td>
                                <td>
                                  <div class="d-grid d-md-flex justify-content-md-center">
                                      <router-link :to="'/RolesUpdate/' + role.id" class="btn btn-primary m-1 me-md-2"><font-awesome-icon icon="fa-solid fa-pen" /></router-link>
                                      <button class="btn btn-danger m-1" @click.prevent="deleteRole(role.id)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" style="display:flex;justify-content:center;width:100%">
                  <ul class="pagination">
                    <li class="page-item" v-bind:class="[{ disabled: !pagination.prev_page_url }]">
                      <a class="page-link" href="#" @click="getRole(pagination.prev_page_url)" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="page-item disabled"><a class="page-link" href="#">{{ pagination.currentPage }} - {{ pagination.last_page }}</a></li>
                    <li class="page-item" v-bind:class="[{ disabled: !pagination.next_page_url }]">
                      <a class="page-link" href="#"  @click="getRole(pagination.next_page_url)" aria-label="Next">
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