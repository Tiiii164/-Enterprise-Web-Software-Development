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
      current_user: {},
      roles: new Set(),
      permissions: new Set(),
    }
  },
  created() {
      console.log(window.user);
      console.log(window.user_roles);
      console.log(window.user_permissions);     
      
      this.current_user = window.user

      window.user_roles.forEach(r => {
        this.roles.add(r.name);
      });

      window.user_permissions.forEach(p => {
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
            <h1 class="text-center"> Welcome <span class="text-success">{{ current_user.name }}</span> </h1>
          </div>
        </div>
    </div>
    <theFooter></theFooter>
  </template>
  
  