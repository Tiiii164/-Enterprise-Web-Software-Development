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
      ideas: []
    }
  },
  setup() {
    const router = useRouter();
    const form = reactive({
      name: '',
      closure_date: '',
      final_closure_date: '',
    })
    const handlecreateIdeas = async () => {
      try {
        const response = await axios.post('/api/ideas/IdeasCreate', form)
          .then((res) => {
            router.push('/IdeasIndex')
          })
        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    }
    return {
      form,
      handlecreateIdeas,
    }
  }
}
</script>
<template>
  <NavBar></NavBar>
  <form @submit.prevent="handlecreateIdeas" method="post">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3>Create new Ideas</h3>
            </div>
            <div class="col-md-6">
              <router-link to="/IdeasIndex" class="btn btn-primary float-end">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <strong>Name</strong>
                  <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter Idea">
                </div>
                <div class="form-group">
                  <strong>Closure Date</strong>
                  <input type="date" name="name" class="form-control" v-model="form.closure_date"
                    placeholder="Enter Closure Date">
                </div>
                <div class="form-group">
                  <strong>Final Closure Date</strong>
                  <input type="date" name="name" class="form-control" v-model="form.final_closure_date"
                    placeholder="Enter Final Closure Date">
                </div>
                <button type="submit" class="btn btn-primary mt-2" @click.prevent="handlecreateIdeas">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </form>
  <TheFooter></TheFooter></template>