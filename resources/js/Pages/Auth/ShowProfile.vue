<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { onMounted } from 'vue';
export default {
  components: {
    NavBar,
    TheFooter
  },
  data(){
    return {
      user: {
        name: '',
        email: ''
      }
    }
  },
  methods: {
    async showProfile() {
    try {
        const req = await axios.get('/api/auth/ShowProfile', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('Idea_token')}`
          }
        })
        this.value = req.data
    } catch (e) {
      console.log(e);
    }
  }
  },
  mounted() {
    this.showProfile()
  },
}
</script>

<template>
  <NavBar></NavBar>
  <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>User Info</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                <div>
                  <p>Name: {{ user.name }}</p>
                  <p>Email: {{ user.email }}</p>
                </div>
                    <div>
                        <router-link :to="'/UpdateProfile/' + user.id" class="btn btn-primary">Edit</router-link>
                    </div>
                </table> 
            </div> 
        </div>
    </div>
  <TheFooter></TheFooter>
</template>
