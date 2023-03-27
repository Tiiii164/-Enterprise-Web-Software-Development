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
      pagination:{},
    }
  },
  created() {
    this.getIdeas();
    //this.getTopics();
  },
  methods: {
    getIdeas(page_url) {
      axios.get('page_url').then(response => {
        let vm = this;
        page_url = page_url || '/api/ideas/IdeasIndex';
        this.ideas = response.data.ideas
        this.topics = response.data.topics;
        console.log(response.data);
        vm.makePagination(res.meta, res.links);
        // console.log(topics[idea.topic_id].name);
      })
    },
    makePagination:function(meta,links){
      let pagination = {
        currentPage: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      }
      this.pagination = pagination;
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
  <div class="backgroundsu">
    <div class="container text-center mt-5 position-absolute start-50 translate-middle-x text-light">
      <div class="card border-light">
          <div class="card-header">
              <div class="table-responsive">
                <table class="table mx-auto border-light">
                  <thead class="text-align-center justify-content-center text-light">
                    <tr>
                      <th>
                        <div v-for="topic in topics" :key="topic.id">
                          <div class="d-grid d-md-flex justify-content-md-start">
                            <i> Ideas of the topic: {{ topic.name }} (Closure Date: {{ topic.closure_date }}) </i>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div class="d-grid d-md-flex justify-content-md-end">
                          <router-link to="/IdeasCreate" class="btn btn-primary">Add new Ideas</router-link>
                        </div>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
          </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm mx-auto border-light">
          <thead class="text-light text-align-center justify-content-center">
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Text</th>
              <th>File Path</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="catetbody text-light">
            <tr v-for="(ideas, index) in ideas" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ ideas.text }}</td>
              <td>{{ ideas.title }}</td>
              <td>{{ ideas.file_path }}</td>
              <td>{{ ideas.created_at }}</td>
              <td>{{ ideas.updated_at }}</td>
              <td>
                <div class="d-grid d-md-flex justify-content-md-center">
                  <router-link :to="'/IdeasUpdate/' + ideas.id" class="btn btn-primary me-md-2"><font-awesome-icon icon="fa-solid fa-pen" /></router-link>
                  <button class="btn btn-danger" @click.prevent="deleteIdeas(ideas.id)"><font-awesome-icon icon="fa-solid fa-trash" /></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" style="display:flex;justify-content:center;width:100%">
          <ul class="pagination">
            <li class="page-item" v-bind:class="[{ disabled: !pagination.prev_page_url }]">
              <a class="page-link" href="#" @click="getIdeas(pagination.prev_page_url)" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item" v-bind:class="[{ disabled: !pagination.next_page_url }]">
              <a class="page-link" href="#"  @click="getIdeas(pagination.next_page_url)" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
        </div>
      </div>
    </div>
  </div>
</div>
  <TheFooter></TheFooter>
</template>