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
    <form >
      <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                  <div class="col-md-6 catecenter" >
                        <h3>Edit category</h3>
                    </div>
                    <div class="col-md-6 catecenter" >
                        <router-link to="/CategoriesIndex" class="btn btn-primary catebutton">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateCategory">
                    <div class="row">
                      <div class="col-md-6 catecenter" >
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
      <div>
        <img src="../../../css/login.jpg" alt="" class="vh-100 backgroundsu" style=" width:100%">
    </div>
    </form>
  <TheFooter></TheFooter>
  </template>