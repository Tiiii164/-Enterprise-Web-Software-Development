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
        await axios.patch(`/api/categories/CategoriesUpdate/${this.$route.params.id}`)
        .then((res) => {
          const { name } = res.data
          this.category.name = name
        });
      } catch (error) {
        console.log(error);
      }
    },
    async updateCategory() {
      try {
        await axios.patch(`/api/categories/CategoriesUpdate/${this.$route.params.id}`, this.category)
        .then((res) => {
          alert("Updated Successfully.")
          this.$router.push('/CategoriesIndex')
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
  <div class="backgroundsu">
    <form>
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class=" d-grid d-md-flex justify-content-md-between">
                  <div class="justify-content-md-start">
                        <h3>Edit category</h3>
                    </div>
                    <div class="justify-content-md-end">
                        <router-link to="/CategoriesIndex" class="btn btn-primary">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body border-light">
                <form @submit.prevent="updateCategory">
                  <div class="mb-3 row">
                    <label class="col-sm-12 col-form-label"><h4>Name</h4></label>
                    <div class="col-sm-12">
                      <input type="text" name="name" v-model="category.name"  class="form-control">
                    </div>
                  </div>
                  <div class="d-grid d-md-flex justify-content-md-end">
                    <button class="btn btn-primary mt-2" type="submit">Update</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
  </template>