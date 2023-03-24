<script>
import NavBar from '@/Components/NavBar.vue';
import theFooter from '@/Components/TheFooter.vue';
import evaluationStudent from '@/Components/EvaluationStudent.vue'
import universityGreenwich from '@/Components/UniversityGreenwich.vue'
export default {
  components: {
      NavBar,
      theFooter,
      evaluationStudent,
      universityGreenwich
  },
  data() {
    return {
      currentUser: {},
    }
},
  created() {
      this.getCurrentUser()
},
  methods: {
    getCurrentUser() {
      axios.get('/getCurrentUser')
        .then(response => { 
          this.currentUser = response.data
          console.log(this.currentUser)
        }
      )
      .catch(error => { console.log(error) }
      )
  },
},
} 
</script>
<template>
  <NavBar></NavBar>
  <div class="position-relative">
    <div class="homeImage">
      <div class="container mt-5 position-absolute start-50 translate-middle-x">
        <div class="homeText text-center justify-content-center">
          <div class="col-sm-8 mx-auto">
            <h1 class="text-center "> Hello,<span class="text-danger">{{ currentUser.name }}!</span></h1>
          </div>
          <div class="d-flex justify-content-center">
            <h2 class="">Welcome to <br> <strong class="" style="color:blue">FPT Greenwich</strong> University</h2>
          </div>
          <div>
            <h5 class="text-center greenwich d-none d-md-block" style="font-weight:900;font-family:cursive">
              Greenwich VietNam is an international joint program between the University of Greenwich,UK and FPT University
            </h5>
          </div>
        </div>
      </div>
    </div>
    <div>
      <evaluationStudent></evaluationStudent>
    </div>
    <div>
      <universityGreenwich></universityGreenwich>
    </div>
  </div>
  <theFooter></theFooter>
</template>
<style>
</style>
  