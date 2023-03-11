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
    <form @submit.prevent="handlecreateCategory" method="post">
      <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                  <div class="col-md-6 catecenter" >
                        <h3>Create new Category</h3>
                    </div>
                    <div class="col-md-6 catecenter" >
                        <router-link to="/CategoriesIndex" class="btn btn-primary catebutton">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('categories.store')}}" method="POST">
                    <div class="row">
                      <div class="col-md-6 catecenter" >
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter category's name">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2"  @click.prevent="handlecreateCategory">Create</button>
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