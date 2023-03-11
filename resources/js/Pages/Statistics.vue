<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
    components: {
      NavBar,
      TheFooter,
    },
    data() {
    return {
      user: [],
      roles: [],
      ideas: [],
      departments: [],
    }
  },
  created() {
    this.countRole();
    this.countIdeas();
    this.countIdeas_User();
    this.countDepartments();
  },
  methods: {
    async countIdeas_User() {
      try {
        const response = await axios.get('/api/user');
        this.user = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async countRole() {
      try {
        const response = await axios.get('/api/roles');
        this.roles = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async countDepartments() {
      try {
        const response = await axios.get('/api/departments');
        this.departments = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async countIdeas() {
      try {
        const response = await axios.get('/api/ideas/IdeasIndex');
        this.ideas = response.data.ideas
      } catch (error) {
        console.log(error);
      }
    },
    async mostViews() {
      try {
        const response = await axios.get('/api/ideas/');
        this.ideas = response.data.ideas
      } catch (error) {
        console.log(error);
      }
    },
    sortedViews: function(arr) {
        return arr.slice(0, 5).sort(function(a, b) {
        return b.views_count - a.views_count;
      });
    }
  },
}
</script>
<template>
    <NavBar></NavBar>
    <div class="container text-center mt-5">
        <div class="row" style="height: 100%;">
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
              <div><h4>Departments with Ideas</h4></div>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                    <div class="d-flex justify-content-between border-bottom">
                        <div>{{ department.name }}</div>
                        <div>{{ department.ideas_count }}</div>                     
                    </div>
                </div>
            </div>
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
              <div><h4>Percentage of Ideas</h4></div>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                      <div class="d-flex justify-content-between border-bottom">
                        <div>{{ department.name }}</div>                        
                        <div>{{ parseFloat(department.ideas_count / ideas.length * 100).toFixed(1) }} %</div>                     
                      </div>
                </div>
            </div>
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
                <div><h4>Departments with Contributors</h4></div>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                    <div class="d-flex justify-content-between border-bottom">
                        <div>{{ department.name }}</div>
                        <div>{{ department.users_count }}</div>                     
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" style="height: 100%;">
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
              <div><h4>Users with Ideas</h4></div>
              <div v-for="(user) in user.slice(0,5)" :key="user" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom">
                      <div>{{ user.name }}</div>
                      <div>{{ user.ideas_count }}</div>                     
                  </div>
              </div>
            </div>
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
              <div><h4>Roles with Users</h4></div>
              <div v-for="(role) in roles.slice(0,5)" :key="role" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom">
                      <div>{{ role.name }}</div>
                      <div>{{ role.users_count }}</div>
                  </div>
              </div>
            </div>
            <div class="col-sm-4 .col-md-6 .col-lg-12 border">
              <div><h4>Ideas with most Views</h4></div>
              <div v-for="(idea) in sortedViews(ideas)" :key="idea" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom">
                      <div>{{ idea.title }}</div>
                      <div>{{ idea.views_count }}</div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>