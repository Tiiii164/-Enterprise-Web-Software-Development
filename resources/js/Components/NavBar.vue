<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router"
import { request } from "../helper";
export default {
  setup() {
    const user = ref()
    const isLoading = ref()
    const router = useRouter();
    onMounted(() => {
      authentication()
    });
    const authentication = async () => {
        isLoading.value = true
        try {
            const req = await request('get', '/api/user')
            user.value = req.data
        } catch (e) {
            router.push('/Login')
        }
    }
    const handleLogout = () => {
        localStorage.removeItem('Idea_token')
        router.push('/Login')
    }
    return {
            user,
            handleLogout,
        }
  }
}
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/Home">Idea</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-between" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/StaffSubmission">Staff Submission</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/Admin">Admin</router-link>
        </li>
      </ul>
      <div class="d-flex">
        <span class="capitalize">Hello, {{ user && user.name }} 
            <button type="button" class="btn btn-outline-primary btn-sm" @click="handleLogout">Logout</button>
        </span>
      </div>
    </div>
  </div>
</nav>
</template>