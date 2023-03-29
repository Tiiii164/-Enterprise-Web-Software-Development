<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { reactive } from "vue";
import { useRouter } from "vue-router";
export default {
    components: {
      NavBar,
      TheFooter,
    },
    setup() {
        const router = useRouter();
        const form = reactive({
            name: '',
        })
    const handlecreateCategory = async() => {
      try {
        const response = await axios.post('/api/categories/CategoriesCreate', form)
        .then((res) => {
                router.push('/CategoriesIndex')
            })
      } catch (error) {
        console.error(error);
      }
    }
    return {
        form,
        handlecreateCategory,
    }
  }
}
</script>

<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form @submit.prevent="handlecreateCategory" method="post">
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
            <div class="card-header border-light">
                <div class="d-grid d-md-flex justify-content-md-between">
                  <div class="justify-content-md-start">
                      <h3>Create new Category</h3>
                    </div>
                    <div class="justify-content-md-end">
                        <router-link to="/CategoriesIndex" class="btn btn-primary">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body border-light">
                <form action="{{route('categories.store')}}" method="POST">
                    <div class="mb-3 row">
                        <label class="col-sm-12 col-form-label"><h4>Name</h4></label>
                        <div class="col-sm-12">
                          <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter Category name">
                        </div>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <button type="submit" class="btn btn-primary mt-2"  @click.prevent="handlecreateCategory">Create</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </form>
  </div>
    <TheFooter></TheFooter>
</template>