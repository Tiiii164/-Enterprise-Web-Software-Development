<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
export default {
    components: {
        NavBar,
        TheFooter
    },
    data() {
        return {
            ideas: [],
            topics: [],
        }
    },
    created() {
        this.getTopics();

    },
    mounted() { },
    methods: {
        getTopics() {
            axios.get('/api/topics/TopicsShow/{id}').then(response => {
                this.ideas = response.data.ideas
                this.topics = response.data.topics;
                console.log(response.data);

            })
        },


        async deleteTopics(id) {
            if (confirm("Are you sure you want to delete this Topic?")) {
                try {
                    const response = await axios.delete(`/api/topics/delete/${id}`);
                    console.log(response.data);
                    this.getTopics();
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
}
</script>
<template>
    <NavBar></NavBar>

    <TheFooter></TheFooter>
</template>