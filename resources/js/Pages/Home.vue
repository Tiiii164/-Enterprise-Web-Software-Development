<script>
import NavBar from '@/Components/NavBar.vue';
import theFooter from '@/Components/TheFooter.vue';
export default {
  components: {
      NavBar,
      theFooter,
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
    <div style="width:100%;position:absolute" class="welcomeuser">
      <div class="jumbotron mt-5">
          <div class="col-sm-8 mx-auto hellotext">
            <h1 class="text-center hellotext textuser"> Hello, <span class="text-success textuser" >{{ currentUser.name }}!</span> <span class="text-success textuser"></span></h1>
          </div>
          <div style="display:flex;justify-content:center">
            <h2 class="text-center welcometext" >Welcome to <h2 class="welcometext" style="padding-left:10px;padding-right:10px;color:blue">FPT Greenwich</h2> University</h2>
          </div>
          <div>
            <h5 class="text-center greenwich" style="font-weight:900;font-family:cursive">
              Greenwich VietNam is an international joint program between the University of Greenwich,UK and FPT University
            </h5>
          </div>
      </div>
    </div>
    <div>
      <img src="../../css/background1.jpg" alt="" style="width:100%;" class="background2">
    </div>
    <theFooter></theFooter>
  </template>
  
  