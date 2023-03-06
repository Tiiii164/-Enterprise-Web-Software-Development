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
  data() {
    return {
      ideas: [],
      categories: [],
    }
  },
  setup() {
    const router = useRouter();
    const form = reactive({
      title: '',
      text: '',
      file_path: '',
      category_id: '',
    })
    const handlecreateIdeas = async () => {
      try {
        const response = await axios.post('/api/ideas/IdeasCreate', form)
          .then((res) => {
            router.push('/IdeasIndex')
          })
        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    }
    return {
      form,
      handlecreateIdeas,
    }
  },
  methods: {
        async getCategories() {
            axios.get('/api/categories')    
            .then((response) => { 
                this.categories = response.data;
            });
        }
    },
    created() {
        this.getCategories();
    }
}
</script>
<template>
  <NavBar></NavBar>
  <form @submit.prevent="handlecreateIdeas" method="post">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3>Create new Ideas</h3>
            </div>
            <div class="col-md-6">
              <router-link to="/TopicsIndex" class="btn btn-primary float-end">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <strong>Title</strong>
                  <input type="text" name="title" class="form-control" v-model="form.title" placeholder="Enter Title">
                </div>
                <div class="form-group">
                  <strong>Text</strong>
                  <input type="text" name="text" class="form-control" v-model="form.text" placeholder="Enter Idea">
                </div>
                <div class="form-group">
                  <strong>File Path</strong>
                  <input type="text" name="file_path" class="form-control" v-model="form.file_path" placeholder="">
                </div>
                <div class="form-group">
                    <strong>Category</strong>
                    <select class="form-select form-control" v-model="form.category_id">
                        <option v-for="data in categories" :value="data.id">{{ data.name }}</option>
                    </select>    
                </div>
                <button type="submit" class="btn btn-primary mt-2" @click.prevent="handlecreateIdeas">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </form>
  <TheFooter></TheFooter>
</template>