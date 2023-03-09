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
      topics: {
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
          alert("Updated Successfully.")
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
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3>Edit Topics</h3>
            </div>
            <div class="col-md-6">
              <router-link to="/TopicsIndex" class="btn btn-primary float-end">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form @submit.prevent="updateTopics">
            <div class="row">
              <div class="col-md-6">
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
  </form>
  <TheFooter></TheFooter>
</template>