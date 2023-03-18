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
    <div class="statistics backgroundsu">
      <div class="container text-center mt-5 position-absolute start-50 translate-middle-x">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Departments with Ideas</h4>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom text-light">
                    <div>{{ department.name }}</div>
                    <div>{{ department.ideas_count }}</div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Percentage of Ideas</h4>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom border-light text-light">
                    <div>{{ department.name }}</div>
                    <div>{{ parseFloat(department.ideas_count / ideas.length * 100).toFixed(1) }} %</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Departments with Users</h4>
                <div v-for="(department) in departments.slice(0,5)" :key="department" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom border-light text-light">
                    <div>{{ department.name }}</div>
                    <div>{{ department.users_count }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Roles with Users</h4>
                <div v-for="(role) in roles.slice(0,5)" :key="role" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom border-light text-light">
                    <div>{{ role.name }}</div>
                    <div>{{ role.users_count }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Users with Ideas</h4>
                <div v-for="(user) in user.slice(0,5)" :key="user" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom border-light text-light">
                    <div>{{ user.name }}</div>
                    <div>{{ user.ideas_count }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-sm-3 rounded-3">
            <div class="col card">
              <div class="card-body">
                <h4 class="card-title text-light">Ideas with most Views</h4>
                <div v-for="(idea) in sortedViews(ideas)" :key="idea" style="height: 50px;">
                  <div class="d-flex justify-content-between border-bottom border-light text-light">
                    <div>{{ idea.title }}</div>
                    <div>{{ idea.views_count }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <TheFooter></TheFooter>
</template>
<style>
@media screen and (max-width: 1000px) {
  .statistics.backgroundsu{
    height: 250vh; 
  }
}
.col {
  --bs-bg-opacity: 0.1;
  background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
  border: 1px solid white;
}
</style>