<script setup lang="ts">
import NavBar from '../Components/NavBar.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'
import TheFooter from '../Components/TheFooter.vue'
</script>

<template>
    <div>
        <NavBar></NavBar>
        <RouterView></RouterView>
    </div>
    <div>
        <the-footer></the-footer>
    </div>
   
</template>
<style>
*{
    margin: 0;
    padding: 0;
}

</style>
