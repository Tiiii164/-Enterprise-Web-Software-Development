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
      category: {
        name: "",
        _method: "patch",
      }
    }
  },
  created() {
    this.showCategory()
  },
  methods: {
    async showCategory() {
      try {
        const response = await axios.patch(`/api/categories/CategoriesUpdate/${this.$route.params.id}`)
        .then((res) => {
          const { name } = res.data
          this.category.name = name
        });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
    }
  },
    async updateCategory() {
      try {
        const response = await axios.patch(`/api/categories/CategoriesUpdate/${this.$route.params.id}`, this.category)
        .then((res) => {
          this.$router.push('/CategoriesIndex')
            });
        console.log(response.data)
      } catch (error) {
        console.log(error);
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
                        <h3>Edit category</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/CategoriesIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateCategory">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Category Name</strong>
                                <input type="text" name="name" v-model="category.name"  class="form-control">
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