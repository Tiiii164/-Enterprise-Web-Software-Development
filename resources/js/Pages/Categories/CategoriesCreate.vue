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
        console.log(response.data);
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
    <form @submit.prevent="handlecreateCategory" method="post">
      <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Create new Category</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/CategoriesIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('categories.store')}}" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter category name">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2"  @click.prevent="handlecreateCategory">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </form>
    <TheFooter></TheFooter>
</template>