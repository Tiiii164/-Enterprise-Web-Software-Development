<script>
import NavBar from '@/Components/NavBar.vue';
import theFooter from '@/Components/TheFooter.vue';
export default{
    components: {
        NavBar,
        theFooter,
    },
    data() {
    return {
      currentUser: {},
      roles: new Set(),
      permissions: new Set(),
    }
  },
  created() {
      console.log(window.user);
      console.log(window.userRoles);
      console.log(window.userPermissions);     
      
      this.currentUser = window.user

      window.userRoles.forEach(r => {
        this.roles.add(r.name);
      });

      window.userPermissions.forEach(p => {
        this.permissions.add(p.name);
      });
    },
}
</script>
<template>
  <NavBar></NavBar>
    <div class="container">
      <div class="jumbotron mt-5">
          <div class="col-sm-8 mx-auto">
            <h1 class="text-center"> Welcome <span class="text-success"> {{ currentUser.name ?? 'None' }} </span></h1>
          </div>
        </div>
    </div>
    <theFooter></theFooter>
  </template>
  
  