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
            email: '',
            name: '',
            password: '',
            password_confirmation: '',
        })
    const handlecreateUser = async() => {
      try {
        const response = await axios.post('/api/users/UsersCreate', form)
        .then((res) => {
                router.push('/UsersIndex')
            })
        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    }
    return {
        form,
        handlecreateUser,
    }
  }
}
</script>

<template>
  <NavBar></NavBar>
    <form @submit.prevent="handlecreateUser" method="post">
      <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Create new User</h3>
                    </div>
                    <div class="col-md-6">
                        <router-link to="/UsersIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('user.store')}}" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Email</strong>
                                <input type="text" name="email" class="form-control" v-model="form.email" placeholder="Enter email">
                                <strong>Name</strong>
                                <input type="text" name="name" class="form-control" v-model="form.name" placeholder="Enter name">
                                <strong>Password</strong>
                                <input type="password" name="password" class="form-control" v-model="form.password" placeholder="Enter password">
                                <strong>Confirm password</strong>
                                <input type="password" name="password_confirmation" class="form-control" v-model="form.password_confirmation" placeholder="Re-enter password">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2"  @click.prevent="handlecreateUser">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </form>
    <TheFooter></TheFooter>
</template>