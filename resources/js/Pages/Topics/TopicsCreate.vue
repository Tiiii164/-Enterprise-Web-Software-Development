<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { reactive } from "vue";
import { useRouter } from "vue-router";
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
    const handlecreateTopics = async () => {
      try {
        const response = await axios.post('/api/topics/TopicsCreate', form)
          .then((res) => {
            router.push('/TopicsIndex')
          })
      } catch (error) {
        console.error(error);
      }
    }
    return {
      form,
      handlecreateTopics,
    }
  }
}
</script>
<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form @submit.prevent="handlecreateTopics" method="post">
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
            <div class="card-header border-light">
              <div class="d-grid d-md-flex justify-content-md-between">
                  <div class="justify-content-md-start">
                    <h3>Create new Topics</h3>
                  </div>
                  <div class="justify-content-md-end">
                    <router-link to="/TopicsIndex" class="btn btn-primary">Back to list</router-link>
                  </div>
            </div>
          </div>
          <div class="card-body border-light">
            <form>
              <div class="mb-3 row">
                  <div class="form-group">
                    <label class="col-sm-2 col-form-label"><h4>Name</h4></label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter Topic">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-form-label"><h4>Closure Date</h4></label>
                    <div class="col-sm-10">
                      <input type="date" name="name" class="form-control" v-model="form.closure_date"
                        placeholder="Enter Closure Date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-form-label"><h4>Final Closure Date</h4></label>
                    <div class="col-sm-10">
                      <input type="date" name="name" class="form-control" v-model="form.final_closure_date"
                        placeholder="Enter Final Closure Date">
                    </div>
                  </div>
                </div>
                <div class="d-grid d-md-flex justify-content-md-end">
                  <button type="submit" class="btn btn-primary mt-2" @click.prevent="handlecreateTopics">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </form>
  </div>
  <TheFooter></TheFooter>
  </template>