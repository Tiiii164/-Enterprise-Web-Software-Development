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
  <form @submit.prevent="handlecreateTopics" method="post">
    <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
      <div class="card categoriesindex">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 catecenter" >
              <h3>Create new Topics</h3>
            </div>
            <div class="col-md-6 catecenter" >
              <router-link to="/TopicsIndex" class="btn btn-primary catebutton">Back to list</router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6 catecenter" >
                <div class="form-group">
                  <strong>Name</strong>
                  <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter Topic">
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
                <button type="submit" class="btn btn-primary mt-2" @click.prevent="handlecreateTopics">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div>
      <img src="../../../css/login.jpg" alt="" class="vh-100 backgroundsu" style=" width:100%">
  </div>
  </form>
  <TheFooter></TheFooter></template>