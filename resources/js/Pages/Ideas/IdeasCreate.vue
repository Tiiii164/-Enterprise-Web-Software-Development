
<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { reactive } from "vue";
import { useRouter, useRoute } from "vue-router";
import DialogText from '@/Components/DialogText.vue'
export default {
  components: {
    NavBar,
    TheFooter,
    DialogText
  },

  computed: {
    isDeadlinePassed() {
      return this.topics.some(topic => {
        const deadline = new Date(topic.closure_date);
        return deadline < this.currentTime;
      });
    },
  },

  data() {
    return {
      ideas: [],
      user: [],
      topics: [],
      categories: [],
      currentTime: new Date(),
      form: {
        termsAndConditions: false
      },
      showDialog: false,
    }
  },
  setup() {
    const route = useRoute();
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
        const response = await axios.post(`/api/ideas/IdeasCreate/${route.params.topics_id}`, form);
        //const response = await axios.post(`/api/ideas/IdeasCreate/`, form);
        router.push(`/TopicsShow/${route.params.topics_id}`);
        const customAlert = document.createElement('div');
        customAlert.classList.add('custom-alert');
        customAlert.innerHTML = `
          <div class="custom-alert-content">
            <h3>Idea created successfully!</h3>
            <button class="custom-alert-button">OK</button>
          </div>
        `;
        document.body.appendChild(customAlert);
        const customAlertButton = customAlert.querySelector('.custom-alert-button');
        customAlertButton.addEventListener('click', () => {
          customAlert.remove();
        });
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
    //file upload
    onFileSelect(event) {
      this.form.file_path = event.target.files[0];
    },
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
    getTopics() {
      axios.get('/api/topics/TopicsIndex').then(response => {
        if (response.data) {
          this.topics = response.data;
          console.log(response.data);
          const currentTime = new Date();
          this.topics.forEach(topic => {
            const deadline = new Date(topic.closure_date);
            console.log('Deadline:', deadline);
            console.log('Current time:', currentTime);
            console.log(topic.id);
          });
        } else {
          console.error('No topics found');
        }
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
    this.getTopics();
  }
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
                <router-link to="/IdeasIndex" class="btn btn-primary catebutton">Back to list</router-link>
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
            <!-- <div class="mb-3 row">
                                                                                              <label class="col-sm-1 col-form-label"><strong>File Path</strong></label>
                                                                                              <div class="col-sm-11">
                                                                                                <input type="file" name="file_path" class="form-control-file" v-model="form.file_path" placeholder="">
                                                                                              </div>
                                                                                            </div> -->
            <div class="mb-3 row">
              <label class="col-sm-1 col-form-label"><strong>File Path</strong></label>
              <div class="col-sm-11">
                <input type="file" name="file_path" class="form-control-file" v-on:change="onFileSelect" accept=".txt"
                  placeholder="">
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
              <!-- <label class="col-sm-1 col-form-label"><strong>Topic</strong></label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <div class="col-sm-11">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <select class="form-select form-control" v-model="form.topics_id">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <option v-for="data in topics" :value="data.id">{{ data.name }}</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </div> -->

            </div>
            <div>
              <div>
                <label>
                  <input type="checkbox" v-model="form.termsAndConditions" @click.stop>
                </label>
                <span style="margin-left:5px">I agree to the </span>
                <span style="text-decoration:underline;cursor:pointer;" @click="showTermsAndConditions">terms and
                  conditions</span>
              </div>
              <div v-if="showDialog" class="dialog-container"
                style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:100%;height:100%;">
                <!-- Your dialog content here -->
                <div class="card dialog" style="display: flex; flex-direction: column;">
                  <DialogText></DialogText>
                  <div style="justify-content:center;align-items:center;display:flex">
                    <button class="btn btn-primary" style="width:100px;" @click="hideTermsAndConditions">Close</button>
                  </div>
                </div>
              </div>
            </div>
             <!-- <div class="text-danger" v-if="isDeadlinePassed">
              <h5>The deadline has passed</h5>
            </div>
            <div v-else>
              <button type="submit" class="btn btn-primary btn-lg" :disabled="!form.termsAndConditions">
                Submit
              </button>
            </div> -->
            <button type="submit" class="btn btn-primary btn-lg" :disabled="!form.termsAndConditions">
                Submit
              </button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
</template>