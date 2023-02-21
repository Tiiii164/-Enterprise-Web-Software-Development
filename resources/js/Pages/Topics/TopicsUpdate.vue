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

    const updateTopics = async () => {
      try {
        const response = await axios.patch(`/api/topics/TopicsUpdate/${this.$route.params.id}`, form.topics)
          .then((res) => {
            this.$router.push('/TopicsIndex')
          });
        console.log(response.data)
      } catch (error) {
        console.log(error);
      }
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
                  <input type="text" name="name" v-model="topics.name" class="form-control" placeholder="Enter Topic">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Update</button>
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