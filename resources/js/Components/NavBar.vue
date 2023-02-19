<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router"
    const user = ref();
    let router = useRouter();
    onMounted(() => {
      authentication()
    })
    const authentication = async () => {
        isLoading.value = true
      try {
        const req = await request('get', '/api/user')
        user.value = req.data
    } catch (e) {
        await router.push('/')
      }
    }
    const handleLogout = () => {
        localStorage.removeItem('token')
        router.push('/')
    }
export default {}
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Idea</router-link>
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
          <router-link class="nav-link active" aria-current="page" to="/Login">Log In</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/Register">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/Admin">Admin</router-link>
        </li>
      </ul>
      <form class="d-flex">
        <span class="capitalize">Welcome {{ user && user.name }} 
            <a type="button" class="" @click="handleLogout">Logout</a>
        </span>
      </form>
    </div>
  </div>
</nav>
</template>