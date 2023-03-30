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
    const handlecreateRole = async() => {
      try {
        const response = await axios.post('/api/roles/RolesCreate', form)
        .then((res) => {
                router.push('/RolesIndex')
            })
      } catch (error) {
        console.error(error);
      }
    }
    return {
        form,
        handlecreateRole,
    }
  }
}
</script>

<template>
  <NavBar></NavBar>
  <div class="backgroundsu">
    <form @submit.prevent="handlecreateRole" method="post">
      <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
        <div class="card border-light">
            <div class="card-header border-light">
              <div class="d-grid d-md-flex justify-content-md-between">
                <div class="justify-content-md-start">
                  <h3>Create new Roles</h3>
                </div>
                <div class="justify-content-md-end">
                  <router-link to="/RolesIndex" class="btn btn-primary">Back to list</router-link>
                </div>
              </div>
            </div>
            <div class="card-body border-light">
                <form method="POST">
                  <div class="mb-3 row">
                      <label class="col-sm-12 col-form-label"><h4>Name</h4></label>
                      <div class="col-sm-12">
                        <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter role name">
                      </div>
                      <div class="d-grid d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary"  @click.prevent="handlecreateRole">Create</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </form>
  </div>
    <TheFooter></TheFooter>
</template>