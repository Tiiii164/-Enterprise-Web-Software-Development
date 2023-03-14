
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
      user: [],
      topics: [],
      categories: [],
      form: {
        termsAndConditions: false
      },
      showDialog: false,
    }
  },
  setup() {
    const router = useRouter();
    const form = reactive({
      title: '',
      text: '',
      file_path: '',
      categories_id: '',
      topics_id: '',
      user_id: '',
      departments_id: '',
      termsAndConditions: false,
    });
    const handleCreateIdeas = async () => {
      try {
        const response = await axios.post('/api/ideas/IdeasCreate', form)
          .then((res) => {
            router.push('/IdeasIndex')
          })
      } catch (error) {
        console.error(error);
      }
    };
    return {
      form,
      handleCreateIdeas,
    };
  },
  methods: {
    async getCategories() {
      axios.get('/api/categories')
        .then((response) => {
          this.categories = response.data;
        });
      axios.get('/api/topics')
        .then((response) => {
          this.topics = response.data;
        });
    },
    showTermsAndConditions() {
      this.showDialog = true;
    },
    hideTermsAndConditions() {
      this.showDialog = false;
    },
  },
  created() {
    this.getCategories();
  },
}
</script>
<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form @submit.prevent="handleCreateIdeas" method="post">
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class="d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Create new Ideas</h3>
              </div>
              <div class="justify-content-md-end">
                <router-link to="/TopicsIndex" class="btn btn-primary catebutton">Back to list</router-link>
              </div>
            </div>
        </div>
        <div class="card-body border-light">
          <div class="mb-3 row">
            <label class="col-sm-1 col-form-label"><strong>Title</strong></label>
            <div class="col-sm-11">
                <input type="text" name="title" class="form-control" v-model="form.title" placeholder="Enter Title">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-1 col-form-label"><strong>Text</strong></label>
            <div class="col-sm-11">
                <input type="text" name="title" class="form-control" v-model="form.text" placeholder="Enter Idea">
            </div> 
          </div>
          <div class="mb-3 row">
                <label class="col-sm-1 col-form-label"><strong>File Path</strong></label>
                <div class="col-sm-11">
                  <input type="text" name="file_path" class="form-control" v-model="form.file_path" placeholder="">
                </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-1 col-form-label"><strong>Category</strong></label>
                <div class="col-sm-11">
                  <select class="form-select form-control" v-model="form.categories_id">
                    <option v-for="data in categories" :value="data.id">{{ data.name }}</option>
                  </select>
                </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-1 col-form-label"><strong>Topic</strong></label>
                <div class="col-sm-11">
                  <select class="form-select form-control" v-model="form.topics_id">
                    <option v-for="data in topics" :value="data.id">{{ data.name }}</option>
                  </select>
                </div>
          </div>
              <div>
                <div>
                <label>
                  <input type="checkbox" v-model="form.termsAndConditions" @click.stop>
                </label>
                <span style="margin-left:5px">I agree to the </span>
                <span style="text-decoration:underline;cursor:pointer;" @click="showTermsAndConditions">terms and conditions</span>
              </div>
              <div v-if="showDialog" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:80%;height:50%">
                <!-- Your dialog content here -->
                <div class="card" style="display: flex; justify-content: space-between;">
                  <h1 style="text-align:center">Terms and Conditions</h1>
                  <div style="justify-content:center;align-items:center;display:flex">
                  <button class="btn btn-primary" style="width:100px;" @click="hideTermsAndConditions">Close</button>
                </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2" :disabled="!form.termsAndConditions" @click.prevent="handleCreateIdeas()">Create</button>
          </div>
        </div>
      </div>
  </form>
  </div>
  <TheFooter></TheFooter>
</template>