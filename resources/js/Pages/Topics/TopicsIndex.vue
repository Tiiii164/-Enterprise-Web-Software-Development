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
      topics: []
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
      } catch (error) {
        console.log(error);
      }
    },
    async deleteTopics(id) {
      if (confirm("Are you sure you want to delete this Topic?")) {
        try {
          const response = await axios.delete(`/api/topics/delete/${id}`);
          console.log(response.data);
          this.getTopics();
        } catch (error) {
          console.log(error);
        }
      }
    }
  },
}
</script>
<template>
  <NavBar></NavBar>
  <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
    <div class="card categoriesindex">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 catecenter">
            <h3>Manage Topics</h3>
          </div>
          <div class="col-md-6 catecenter">
            <router-link to="/TopicsCreate" class="btn btn-primary catebutton">Add new Topics</router-link>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered mx-auto">
          <thead style="text-align:center;align-items:center;justify-content:center">
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Closure Date</th>
              <th>Final Closure Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="catetbody">
            <tr v-for="(topics, index) in topics" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ topics.name }}</td>
              <td>{{ topics.closure_date }}</td>
              <td>{{ topics.final_closure_date }}</td>
              <td>
                <div>
                  <router-link :to="'/TopicsUpdate/' + topics.id" class="btn btn-primary">Edit</router-link>
                  <button class="btn btn-danger" @click.prevent="deleteTopics(topics.id)">Delete</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div>
    <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
</div>
  <TheFooter></TheFooter>
</template>