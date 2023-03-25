<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { reactive } from "vue";
import { useRouter } from "vue-router";
export default {
    components: {
      NavBar,
      TheFooter,
    },
    setup() {
        const router = useRouter();
        const form = reactive({
            name: '',
        })
    const handlecreateDepartments = async() => {
      try {
        const response = await axios.post('/api/departments/DepartmentsCreate', form)
        .then((res) => {
                router.push('/DepartmentsIndex')
            })
      } catch (error) {
        console.error(error);
      }
    }
    return {
        form,
        handlecreateDepartments,
    }
  }
}
</script>

<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form @submit.prevent="handlecreateDepartments" method="post">
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
            <div class="card-header border-light">
              <div class="d-grid d-md-flex justify-content-md-between">
                <div class="justify-content-md-start">
                        <h3>Create new Departments</h3>
                    </div>
                    <div class="justify-content-md-end">
                        <router-link to="/DepartmentsIndex" class="btn btn-primary catebutton">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body border-light">
                <form method="POST">
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"><h4>Name</h4></label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter Department name">
                    </div>
                  </div>
                  <div class="d-grid d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary" @click.prevent="handlecreateDepartments">Create</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </form>
  </div>
    <TheFooter></TheFooter>
</template>