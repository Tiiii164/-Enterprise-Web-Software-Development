<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
    components: {
      NavBar,
      TheFooter,
    },
}
</script>
<template>
    <NavBar></NavBar>
    <div class="container">
        <div class="table">
            <tbody>
                <tr>
                    <th>!</th>
                    <td>2</td>
                </tr>
            </tbody>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>