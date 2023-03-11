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
  <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 catecenter" >
                        <h3>Manage categories</h3>
                    </div>
                    <div class="col-md-6 catecenter" >
                        <router-link to="/CategoriesCreate" class="btn btn-primary catebutton">Add new category</router-link>
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
    <div>
      <img src="../../../css/login.jpg" alt="" class="vh-100 backgroundsu" style=" width:100%">
  </div>
  <TheFooter></TheFooter>
</template>