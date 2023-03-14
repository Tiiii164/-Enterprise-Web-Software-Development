<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter
  },
  data() {
    return {
      topics: [],

    }
  },
  created() {
    this.getTopics();
  },
  mounted() { },
  methods: {
    async getTopics() {
      try {
        const response = await axios.get('/api/topics/TopicsIndex');
        this.topics = response.data;

        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
  },
}
</script>
<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <div class="container text-center mt-5 position-absolute start-50 translate-middle-x text-light">
      <div class="card border-light">
        <div class="card-header border-light">
          <div class="row">
            <div class="card-body col-2" style="display:flex;justify-content:center;width:100%">
              <h3>Staff Submission</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm mx-auto border-light">
              <thead class="text-light text-align-center justify-content-center">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Closure Date</th>
                  <th>Final Closure Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="catetbody text-light border-light">
                <tr v-for="(topics, index) in topics" :key="index">
                  <td>{{ index + 1 }}</td>
                  <td>{{ topics.name }}</td>
                  <td>{{ topics.closure_date }}</td>
                  <td>{{ topics.final_closure_date }}</td>
                  <td>
                    <div class="d-grid d-md-flex justify-content-md-center">
                        <router-link :to="'/TopicsShow/' + topics.id" class="btn btn-primary me-md-2">View Ideas</router-link>
                        <button class="btn btn-primary me-md-2">Export Zip</button>
                        <button class="btn btn-danger" >Export Excel</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>    
  <TheFooter></TheFooter>
</template>