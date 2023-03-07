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
        async likeIdea(ideasId) {
            const response = await axios.post(`/api/like/${ideasId}`);
            console.log(response.data.message);
            location.reload();
        },

        async dislikeIdea(ideasId) {
            const response = await axios.post(`/api/dislike/${ideasId}`);
            console.log(response.data.message);
            location.reload();
        },

        async viewIdea(ideasId) {
            const response = await axios.post(`/api/view/${ideasId}`);
            console.log(response.data.message);
            location.reload();
        }
    }
}
</script>
<template>
    <NavBar></NavBar>
    <div class="container">
        <h1>List of Ideas</h1>
        <div class="row">
            <div class="col-4">
                <dt>Ideas of Topic: </dt>
                <dt>Closure Date: </dt>
                <dt>Final Closure Date: </dt>
            </div>
            <div class="col-4" v-for="topic in topics" :key="topic">
                <dd>{{ topic.name }}</dd>
                <dd>{{ topic.closure_date }}</dd>
                <dd>{{ topic.final_closure_date }}</dd>
            </div>
        </div>
        <div class="card">
            <div class="card-body col-2">
                <router-link to="/IdeasCreate" class="btn btn-primary float-end">Add new Ideas</router-link>
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
                            <th>Views</th>
                            <th>Like</th>
                            <th>Dislike</th>
                            <th>Action</th>
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
                            <td>{{ ideas.views_count }}</td>
                            <td>{{ ideas.likes_count }}</td>
                            <td>{{ ideas.dislikes_count }}</td>
                            <td>
                                <div>
                                    <router-link :to="'/IdeasShow/' + ideas.id" class="btn btn-success"
                                        @click="viewIdea(ideas.id)">View
                                        Detail</router-link>
                                    <!-- <button class="btn btn-success" @click="viewIdea(ideas.id)">View Details </button> -->
                                    <button class="btn btn-danger" @click="likeIdea(ideas.id)">Like</button>
                                    <button class="btn btn-danger" @click="dislikeIdea(ideas.id)">Dislike</button>
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