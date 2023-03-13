<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
  components: {
    NavBar,
    TheFooter,
  },
  data() {
    return {
      ideas: {
        name: "",
        closure_date: "",
        final_closure_date: "",
        _method: "patch",
      }
    }
  },
  created() {
    this.showTopics()
  },
  methods: {
    async showTopics() {
      const response = await axios.patch(`/api/topics/TopicsUpdate/${this.$route.params.id}`)
        .then((res) => {
          const { name, closure_date, final_closure_date } = res.data
          this.topics.name = name
          this.topics.closure_date = closure_date
          this.topics.final_closure_date = final_closure_date
        }).catch(error => {
          console.log(error);
        })
    },
    async updateTopics() {
      const response = await axios.patch(`/api/topics/TopicsUpdate/${this.$route.params.id}`, this.topics)
        .then((res) => {
          this.$router.push('/TopicsIndex')
        })
        .catch(error => {
          console.log(error);
        })
    }
  }
}
</script>
<template>
  <NavBar></NavBar>
  <form>
    <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
      <div class="card categoriesindex">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 catecenter" >
              <h3>Edit Topics</h3>
            </div>
            <div class="col-md-6">
              <router-link to="/TopicsIndex" class="btn btn-primary catebutton">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form @submit.prevent="updateTopics">
            <div class="row">
              <div class="col-md-6 catecenter" >
                <div class="form-group">
                  <strong>Topic Name</strong>
                  <input type="text" name="name" v-model="topics.name" class="form-control">
                </div>
                <div class="form-group">
                  <strong>Closure Date</strong>
                  <input type="date" name="closure_date" v-model="topics.closure_date" class="form-control">
                </div>
                <div class="form-group">
                  <strong>Final Closure Date</strong>
                  <input type="date" name="final_closure_date" v-model="topics.final_closure_date" class="form-control">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary mt-2" type="submit">Update</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div>
      <img src="../../../css/login.jpg" alt="" class="mh-100 backgroundsu" style=" width:100%">
  </div>
  </form>
  <TheFooter></TheFooter>
</template>