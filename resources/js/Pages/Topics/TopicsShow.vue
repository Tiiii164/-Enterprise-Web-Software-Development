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
        async getTopics() {
            try {
                const response = await axios.get(`/api/topics/TopicsShow/${this.$route.params.id}`)
                this.topics = response.data;
                this.ideas = response.data;
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
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
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <thead>
                            <tr>
                                <td>Ideas of Topic: </td>
                                <td>Closure Date</td>
                                <td>Final Closure Date</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="topics in topics" :key="index">
                                <th>{{ topics.name }}</th>
                                <th>{{ topics.closure_date }}</th>
                                <th>{{ topics.final_closure_date }}</th>
                            </tr>
                        </tbody>




                    </div>
                    <div class="col-md-6">
                        <router-link to="/IdeasCreate" class="btn btn-primary float-end">Add new Ideas</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>File Path</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ideas, index) in topics.ideas" :key="ideas.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ ideas.title }}</td>
                            <td>{{ ideas.text }}</td>
                            <td>{{ ideas.file_path }}</td>
                            <td>{{ ideas.created_at }}</td>
                            <td>{{ ideas.updated_at }}</td>
                            <td>
                                <div>
                                    <router-link :to="'/TopicsUpdate/' + topics.id"
                                        class="btn btn-primary">Like</router-link>
                                    <router-link :to="'/IdeasShow/' + ideas.id"
                                        class="btn btn-primary">Details</router-link>
                                    <button class="btn btn-danger" @click.prevent="deleteIdeas(topics.id)">DisLike</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>