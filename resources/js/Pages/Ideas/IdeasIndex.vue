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
      ideas: [],
      topics: [],
    }
  },
  created() {
    this.getIdeas();
    //this.getTopics();
  },
  methods: {
    getIdeas() {
      axios.get('/api/ideas/IdeasIndex').then(response => {
        this.ideas = response.data.ideas
        this.topics = response.data.topics;
        console.log(response.data);

        // console.log(topics[idea.topic_id].name);
      })
    },
    getTopics() {
      axios.get('/api/topics/TopicsIndex').then(response => {
        this.topics = response.data.topics
        console.log(response.data);


      })
    },
    // getTopics() {
    //   axios.get('/api/topics/TopicsIndex').then(response => {
    //     this.topics = response.data.topics
    //     console.log(response.data);
    //   })
    // },

    async deleteIdeas(id) {
      if (confirm("Are you sure you want to delete this Idea?")) {
        try {
          const response = await axios.delete(`/api/ideas/delete/${id}`);
          console.log(response.data);

          this.getIdeas();
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
            <div v-for="topic in topics" :key="topic.id">
              <thead>
                <tr>
                  <th>Ideas of the topic: {{ topic.name }}</th>
                  <th>Closure Date: {{ topic.closure_date }}</th>
                </tr>
              </thead>
            </div>
          </div>
          <div class="col-md-6">
            <router-link to="/IdeasCreate" class="btn btn-primary float-end">Add new Ideas</router-link>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Text</th>
              <th>File Path</th>
              <th>Created At</th>
              <th>Updated At</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="(ideas, index) in ideas" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ ideas.text }}</td>
              <td>{{ ideas.title }}</td>
              <td>{{ ideas.file_path }}</td>
              <td>{{ ideas.created_at }}</td>
              <td>{{ ideas.updated_at }}</td>

              <td>
                <div>
                  <router-link :to="'/IdeasUpdate/' + ideas.id" class="btn btn-primary">Edit</router-link>
                  <button class="btn btn-danger" @click.prevent="deleteIdeas(ideas.id)">Delete</button>
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