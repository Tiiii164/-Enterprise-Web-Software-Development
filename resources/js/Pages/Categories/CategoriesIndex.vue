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
  <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Manage categories</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/CategoriesCreate" class="btn btn-primary float-end">Add new category</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(category, index) in categories" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ category.name }}</td>
                                <td>
                                    <div>
                                      <router-link :to="'/CategoriesUpdate/' + category.id" class="btn btn-primary">Edit</router-link>
                                      <button class="btn btn-danger" @click.prevent="deleteCategory(category.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>