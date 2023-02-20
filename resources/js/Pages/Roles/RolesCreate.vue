<script>
import { reactive } from "vue";
import { useRouter } from "vue-router";
export default {
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
        // handle success
        console.log(response.data);
      } catch (error) {
        // handle error
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
    <form @submit.prevent="handlecreateRole" method="post">
      <div>
        <label>Name:</label>
        <input type="text" v-model="form.name">
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
</template>