<script>
import NavBar from '@/Components/NavBar.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { useRouter } from 'vue-router';
import { reactive } from "vue";
import axios from 'axios';

export default {
    components: {
        NavBar,
        TheFooter
    },
    data() {
        return {
            ideas: {},
            topics: [],
            comments: [],
            categories: [],
        }
    },
    
    setup() {
        const router = useRouter();
        //const route = useRoute();
        const form = reactive({
            text: '',
            ideas_id: '',
        })
        const handlecreateComments = async () => {
            try {
                // const response = await axios.post(`/api/ideas/IdeasShow/${this.$route.params.id}`, form)
                const response = await axios.post(`/api/ideas/IdeasShow/${router.currentRoute.value.params.id}`, form)
                    .then((res) => {

                        router.push('/IdeasShow')

                    })
                location.reload();
            } catch (error) {
                console.error(error);
            }
        }
        return {
            form,
            handlecreateComments,
        }
    },

    methods: {
        async getIdeas() {
            try {
                const response = await axios.get(`/api/ideas/IdeasShow/${this.$route.params.id}`)
                    this.ideas = response.data;
                    this.topics = response.data;
                    this.comments = response.data;
                    this.categories = response.data;
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        },
        async deleteIdeas(id) {
            if (confirm("Are you sure you want to delete this Idea?")) {
                try {
                    const response = await axios.delete(`/api/ideas/delete/${id}`);
                    console.log(response.data);
                    this.getIdeas();
                } catch (error) {
                    console.log(error);
                }
            }
        }
    },
    created() {
        this.getIdeas();
    }
}
</script>
<template>
<NavBar></NavBar>
    <div class="ideasShow backgroundsu">
        <div class="container mt-5 position-absolute start-50 translate-middle-x text-light">
            <form @submit.prevent="handlecreateComments" method="post"> 
                <div class="card border-light">
                    <div class="card-header">
                        <div class="table-responsive">
                            <table class="table table-sm mx-auto">
                                <thead class="text-light text-align-center justify-content-center">
                                    <tr>
                                        <th>
                                            <div class="d-grid d-md-flex justify-content-md-start pb-3">
                                                <h3>Create new Ideas</h3>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-grid d-md-flex justify-content-md-end pb-3">
                                                <router-link to="/TopicsIndex" class="btn btn-primary">Back to list</router-link>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3 row">
                                <div class="form-group">
                                    <label class="col-sm-2 col-form-label"><h4>Comment</h4></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="comments" class="form-control" v-model="form.text"
                                        placeholder="Enter Comments">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2"
                                @click.prevent="handlecreateComments">Create
                            </button>
                        </form>
                    </div>
                </div>
            </form>
            <br>
            <div class="card border-light">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mx-auto border-light">
                            <thead class="text-light text-align-center justify-content-center">
                                <tr>
                                    <td>Title</td>
                                    <td>Content</td>
                                    <td>File Path</td>
                                    <td>View</td>
                                    <td>Topic</td>
                                    <td>Category</td>
                                </tr>
                            </thead>
                            <tbody class="text-light text-align-center justify-content-center" >
                                <tr v-for="idea in ideas" :key="idea.id">
                                    <td>{{ idea.title }}</td>
                                    <td>{{ idea.text }}</td>
                                    <td>{{ idea.file_path }}</td>
                                    <td>{{ idea.views_count }}</td>
                                    <td>
                                        <div>
                                            {{ ideas.topics.name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ ideas.categories.name }}
                                        </div> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card border-light">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mx-auto border-light">
                            <thead class="text-light text-align-center justify-content-center">
                                <tr>
                                    <th>
                                        <div class="d-grid d-md-flex justify-content-md-start pb-3">
                                            <h3>Details</h3>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-grid d-md-flex justify-content-md-end pb-3">
                                            <router-link to="/TopicsIndex" class="btn btn-primary">Back to list</router-link>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Text</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody class="text-light">
                                <tr v-for="comment in ideas.comments" :key="ideas.id">
                                    <td>{{ comment.text }}</td>
                                    <td>{{ comment.created_at }}</td>
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
@media screen and (min-width: 1000px) {
    .ideasShow.backgroundsu {
        height: 250vh; 
    }
}
@media screen and (max-width: 1000px) {
    .ideasShow.backgroundsu {
        height: 250vh; 
    }
}
</style>