
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
  <form @submit.prevent="handleCreateIdeas" method="post">
    <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
      <div class="card categoriesindex">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 catecenter">
              <h3>Create new Ideas</h3>
            </div>
            <div class="col-md-6 catecenter">
              <router-link to="/TopicsIndex" class="btn btn-primary catebutton">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 catecenter">
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
                <select class="form-select form-control" v-model="form.categories_id">
                  <option v-for="data in categories" :value="data.id">{{ data.name }}</option>
                </select>
                <strong>Topic</strong>
                <select class="form-select form-control" v-model="form.topics_id">
                  <option v-for="data in topics" :value="data.id">{{ data.name }}</option>
                </select>
              </div>
              <div>
                <div>
                <label>
                  <input type="checkbox" v-model="form.termsAndConditions" @click.stop>
                </label>
                <span style="margin-left:5px">I agree to the </span>
                <span style="text-decoration:underline;cursor:pointer;" @click="showTermsAndConditions">terms and conditions</span>
              </div>
                <div v-if="showDialog">
                  <!-- Your dialog content here -->
                  <div class="card" style="align-items:center">
                    <h1>term and condition</h1>
                    <button class="btn btn-primary" style="width:20%" @click="hideTermsAndConditions">Close</button>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mt-2" :disabled="!form.termsAndConditions" @click.prevent="handleCreateIdeas()">Create</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
    </div>
  </form>
  <TheFooter></TheFooter>
</template>