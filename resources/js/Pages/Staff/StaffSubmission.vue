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
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6">
            <h3>Staff Submission</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Closure Date</th>
              <th>Final Closure Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(topics, index) in topics" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ topics.name }}</td>
              <td>{{ topics.closure_date }}</td>
              <td>{{ topics.final_closure_date }}</td>
              <td>
                <div class="d-flex justify-content-center">
                    <router-link :to="'/TopicsShow/' + topics.id" class="btn btn-primary me-2">View Ideas</router-link>
                    <button class="btn btn-danger me-2">Export Zip</button>
                    <button class="btn btn-danger me-2" >Export Excel</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <TheFooter></TheFooter>
</template>