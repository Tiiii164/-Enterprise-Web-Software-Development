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
    <div class="topicShow backgroundsu">
        <div class="container text-center mt-5 position-absolute start-50 translate-middle-x text-light">
            <h1>List of Ideas</h1>
            <div class="card border-light mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mx-auto border-light">
                            <thead class="text-light text-align-center justify-content-center">
                                <tr>
                                    <td>ID: </td>
                                    <td>Ideas of Topic: </td>
                                    <td>Closure Date: </td>
                                    <td>Final Closure Date: </td>
                                    <td>Action: </td>
                                </tr>
                            </thead>
                            <tbody class="text-light text-align-center justify-content-center" v-for="topic in topics" :key="topic">
                                <tr  v-if="topic.id > 0">
                                    <td>{{ topic.id }}</td>
                                    <td>{{ topic.name }}</td>
                                    <td>{{ topic.closure_date }}</td>
                                    <td>{{ topic.final_closure_date }}</td>
                                    <td>                        
                                        <router-link :to="'/IdeasCreate/Topic/' + topic.id" class="btn btn-primary ">Add new Ideas</router-link>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="row mb-3">
                <div class="col-4">
                    <dt>Ideas of Topic: </dt>
                    <dt>Closure Date: </dt>
                    <dt>Final Closure Date: </dt>
                </div>
                <div class="col-4" v-for="topic in topics" :key="topic">
                    <div v-if="topic.id > 0">
                        <dd>{{ topic.name }}</dd>
                        <dd>{{ topic.closure_date }}</dd>
                        <dd>{{ topic.final_closure_date }}</dd>
                        <div>
                            <router-link :to="'/IdeasCreate/Topic/' + topic.id" class="btn btn-primary ">Add new Ideas</router-link>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="card" style="display:flex">
                <div class="card-body border-light">
                    <div class="table-responsive">
                        <table class="table table-sm mx-auto border-light">
                            <thead class="text-light text-align-center justify-content-center">
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <!-- <th>Text</th>
                                    <th>File Path</th>
                                    <th>Created At</th>
                                    <th>Updated At</th> -->
                                    <th>Views</th>
                                    <th>Like</th>
                                    <th>Dislike</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="catetbody text-light">
                                <tr v-for="(ideas, index) in topics.ideas" :key="ideas.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ ideas.title }}</td>
                                    <!-- <td>{{ ideas.text }}</td>
                                    <td>{{ ideas.file_path }}</td>
                                    <td>{{ ideas.created_at }}</td>
                                    <td>{{ ideas.updated_at }}</td> -->
                                    <td>{{ ideas.views_count }}</td>
                                    <td>{{ ideas.likes_count }}</td>
                                    <td>{{ ideas.dislikes_count }}</td>
                                    <td>
                                        <div class="d-grid d-md-flex justify-content-md-center">
                                            <router-link :to="'/IdeasShow/' + ideas.id" class="btn btn-success m-1"
                                                @click="viewIdea(ideas.id)"><font-awesome-icon
                                                    icon="fa-solid fa-book" /></router-link>
                                            <!-- <button class="btn btn-success" @click="viewIdea(ideas.id)">View Details </button> -->
                                            <button class="btn text-light btn-info m-1"
                                                @click="likeIdea(ideas.id)"><font-awesome-icon
                                                    icon="fa-solid fa-thumbs-up" /></button>
                                            <button class="btn btn-danger m-1"
                                                @click="dislikeIdea(ideas.id)"><font-awesome-icon
                                                    icon="fa-solid fa-thumbs-down" /></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <TheFooter></TheFooter>
</template>
<style>
@media screen and (max-width: 1000px) {
    .topicShow.backgroundsu {
        height: 250vh;
    }
}
</style>