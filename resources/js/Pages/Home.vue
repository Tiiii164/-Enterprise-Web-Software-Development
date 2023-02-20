<script>
import NavBar from '@/Components/NavBar.vue';
import theFooter from '@/Components/TheFooter.vue';
    export default{
        components: {
            NavBar,
            theFooter,
        }
    }
</script>
<template>
  <NavBar></NavBar>
    <div class="container">
      <div class="jumbotron mt-5">
          <div class="col-sm-8 mx-auto">
            <h1 class="text-center"> Welcome</h1>
          </div>
        </div>
    </div>
    <theFooter></theFooter>
  </template>