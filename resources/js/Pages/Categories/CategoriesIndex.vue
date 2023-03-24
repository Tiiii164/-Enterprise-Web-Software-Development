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
      categories: []
    }
  },
  created() {
    this.getCategory();
  },
  mounted() {},
  methods: {
    async getCategory() {
      try {
        const response = await axios.get('/api/categories/CategoriesIndex');
        this.categories = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteCategory(id) {
      if (confirm("Are you sure you want to delete this category?")) {
        try {
          const response = await axios.delete(`/api/categories/delete/${id}`);
          console.log(response.data);
          this.getCategory();
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
                      <h3 class="">Manage Categories</h3>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <router-link to="/CategoriesCreate" class="btn btn-primary">Add new category</router-link>
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
                              <tr v-for="(category, index) in categories" :key="index">
                                  <td>{{ index + 1 }}</td>
                                  <td>{{ category.name }}</td>
                                  <td>
                                      <div class="d-grid d-md-flex justify-content-md-center">
                                        <router-link :to="'/CategoriesUpdate/' + category.id" class="btn btn-primary m-1 me-md-2"><font-awesome-icon icon="fa-solid fa-pen" /></router-link>
                                        <button class="btn btn-danger m-1" @click.prevent="deleteCategory(category.id)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
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