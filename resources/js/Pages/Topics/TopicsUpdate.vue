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
  <div class="backgroundsu">
    <form>
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
          <div class="card-header border-light">
            <div class=" d-grid d-md-flex justify-content-md-between">
              <div class="justify-content-md-start">
                <h3>Edit Topics</h3>
              </div>
              <div class="justify-content-md-end">
                <router-link to="/TopicsIndex" class="btn btn-primary">Back to list</router-link>
              </div>
            </div>
          </div>
          <div class="card-body border-light">
            <form @submit.prevent="updateTopics">
              <div class="mb-3 row">
                  <div class="form-group">
                    <label class="col-sm-12 col-form-label"><h4>Topic Name</h4></label>
                    <div class="col-sm-12">
                      <input type="text" name="name" v-model="topics.name" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-12 col-form-label"><h4>Closure Date</h4></label>
                    <div class="col-sm-12">
                      <input type="date" name="closure_date" v-model="topics.closure_date" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-12 col-form-label"><h4>Final Closure Date</h4></label>
                    <div class="col-sm-12">
                      <input type="date" name="final_closure_date" v-model="topics.final_closure_date" class="form-control">
                    </div>
                  </div>
                  <div class="d-grid d-md-flex justify-content-md-end">
                    <button class="btn btn-primary mt-2" type="submit">Update</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
</template>