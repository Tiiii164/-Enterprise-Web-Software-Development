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
  setup() {
    const router = useRouter();
    const form = reactive({
      name: '',
      closure_date: '',
      final_closure_date: '',
    })
    const getTopics = async () => {
      try {
        const response = await axios.get('/api/topics/TopicsIndex');
        this.topics = response.data;
      } catch (error) {
        console.log(error);
      }
    }
    const deleteTopics = async (id) => {
      if (confirm("Are you sure you want to delete this topic?")) {
        try {
          const response = await axios.delete(`/api/topics/delete/${id}`);
          console.log(response.data);
          this.getTopics();
        } catch (error) {
          console.log(error);
        }
      }
    }
  }
}
</script>

<template>
  <NavBar></NavBar>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6">
            <h3>Manage Topics</h3>
          </div>
          <div class="col-md-6">
            <router-link to="/TopicsCreate" class="btn btn-primary float-end">Add new Topics</router-link>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Closure Date</th>
              <th>Final Closure Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
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
  <TheFooter></TheFooter>
</template>