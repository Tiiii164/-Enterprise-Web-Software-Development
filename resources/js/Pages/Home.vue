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
  create() {
    console.log(window.user)
    this.currentUser = window.user
  },
} 
</script>
<template>
  <NavBar></NavBar>
    <div class="container">
      <div class="jumbotron mt-5">
          <div class="col-sm-8 mx-auto">
            <h1 class="text-center"> Welcome {{ currentUser.name ?? "None" }} <span class="text-success"></span></h1>
          </div>
        </div>
    </div>
    <theFooter></theFooter>
  </template>
  
  