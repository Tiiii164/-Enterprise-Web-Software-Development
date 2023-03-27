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
      pagination:{},
    }
  },
  created() {
    this.getTopics();
  },
  methods: {
    // async getTopics(page_url) {
    //   try {
    //     const response = await axios.get('page_url');
    //     let vm = this;
    //     page_url = page_url || '/api/topics/TopicsIndex';
    //     this.topics = response.data;
    //     console.log(response.data);
    //     vm.makePagination(res.meta, res.links);
    //     const currentTime = new Date();
    //     console.log('Current Time: ', currentTime)
    //   } catch (error) {
    //     console.log(error);
    //   }
    // },
    // getTopics(page_url) {
    //   axios.get('page_url').then(response => {
    //     let vm = this;
    //     page_url = page_url || '/api/topics/TopicsIndex';
    //     this.ideas = response.data;
    //     console.log(response.data);
    //     vm.makePagination(res.meta, res.links);
    //     // console.log(topics[idea.topic_id].name);
    //   })
    // },
    getTopics: function(page_url){
      let vm = this;
      page_url = page_url || '/api/topics/TopicsIndex';
      fetch(page_url)
      .then(res => res.json())
      .then(res => {
        this.topics = res.data;
        console.log(res.data)
        vm.makePagination(res.meta, res.links);
       console.log([res.meta, res.links])
       
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
          <table class="table border-light">
            <thead class="text-light text-align-center justify-content-center">
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Closure Date</th>
                <th>Final Closure Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="catetbody border-light" v-for="(topics, index) in topics" :key="index" >
              <tr v-if="Date.now() < new Date(topics.closure_date) ">
                <td class="btnValid">{{ index + 1 }}</td>
                <td class="btnValid">{{ topics.name }}</td>
                <td class="btnValid">{{ topics.closure_date }}</td>
                <td class="btnValid">{{ topics.final_closure_date }}</td>
                <td>
                  <div>
                    <router-link :to="'/TopicsShow/' + topics.id" class="btnValid me-md-4 "><span class="d-none d-md-inline">View Ideas</span> <font-awesome-icon icon="fa-solid fa-book" /></router-link>
                    <a class="btnValid me-md-4" ><span class="d-none d-md-inline">Export Excel</span> <font-awesome-icon icon="fa-solid fa-file-excel" /></a>
                    <a class="btnValid"><span class="d-none d-md-inline">Export Zip</span> <font-awesome-icon icon="fa-solid fa-arrow-up-from-bracket" /></a>
                  </div>
                </td>
              </tr>
              <tr v-else-if="new Date(topics.closure_date) < Date.now() && Date.now() < new Date(topics.final_closure_date)">
                <td class="btnWarning">{{ index + 1 }}</td>
                <td class="btnWarning">{{ topics.name }}</td>
                <td class="btnWarning">{{ topics.closure_date }}</td>
                <td class="btnWarning">{{ topics.final_closure_date }}</td>
                <td>
                  <div>
                    <router-link :to="'/TopicsShow/' + topics.id" class="btnWarning me-md-4"><span class="d-none d-md-inline">View Ideas</span> <font-awesome-icon icon="fa-solid fa-book" /></router-link>
                    <a class="btnWarning me-md-4"><span class="d-none d-md-inline">Export Excel</span> <font-awesome-icon icon="fa-solid fa-file-excel" /></a>
                    <a class="btnWarning"><span class="d-none d-md-inline">Export Zip</span> <font-awesome-icon icon="fa-solid fa-arrow-up-from-bracket" /></a>
                  </div>
                </td>
              </tr>
              <tr v-else-if="Date.now() > new Date(topics.final_closure_date)">
                <td class="btnExpired">{{ index + 1 }}</td>
                <td class="btnExpired">{{ topics.name }}</td>
                <td class="btnExpired">{{ topics.closure_date }}</td>
                <td class="btnExpired">{{ topics.final_closure_date }}</td>
                <td>
                  <div>
                    <router-link :to="'/TopicsShow/' + topics.id" class="btnExpired me-md-4 "><span class="d-none d-md-inline">View Ideas</span> <font-awesome-icon icon="fa-solid fa-book" /></router-link>
                    <a class="btnExpired me-md-4" ><span class="d-none d-md-inline">Export Excel</span> <font-awesome-icon icon="fa-solid fa-file-excel" /></a>
                    <a class="btnExpired"><span class="d-none d-md-inline">Export Zip</span> <font-awesome-icon icon="fa-solid fa-arrow-up-from-bracket" /></a>
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
              <li class="page-item disabled"><a class="page-link" href="#">{{ pagination.current_page }} - {{ pagination.last_page }}</a></li>
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
  <TheFooter></TheFooter>
</template>