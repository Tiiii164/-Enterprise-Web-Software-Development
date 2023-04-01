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
    computed: {
        isDeadlinePassed() {
            if (this.topics.length > 0) {
                return this.topics.some(topic => {
                    const deadline = new Date(topic.final_closure_date);
                    return deadline < this.currentTime;
                });
            }
            return false;
        },
    },

    data() {
        return {
            ideas: [],
            topics: [],
            comments: [],
            categories: [],
            currentTime: new Date(),
        }
    },

    setup() {
        const router = useRouter();
        //const route = useRoute();
        const form = reactive({
            text: '',
            ideas_id: '',
        })
        const handleCreateComments = async () => {
            try {
                // const response = await axios.post(`/api/ideas/IdeasShow/${this.$route.params.id}`, form)
                const response = await axios.post(`/api/ideas/IdeasShow/${router.currentRoute.value.params.id}`, form)
                    .then((res) => {
                        // router.push(`/IdeasShow/${router.currentRoute.value.params.id}`)
                        router.push(`/IdeasShow/${route.params.ideas_id}`)

                    })

            } catch (error) {
                console.error(error);
            }
            location.reload();
        }
        return {
            form,
            handleCreateComments,
        }
    },

    methods: {
        getIdeas() {
            axios.get(`/api/ideas/IdeasShow/${this.$route.params.id}`)
            .then(response => {
                this.ideas = [response.data.ideas];
                this.topics = response.data.topics;
                this.comments = response.data.comments;
                this.categories = response.data.categories;
                console.log(response.data)
            })
            .catch (error => {console.log(error)})
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
        },
        // async getTopics() {
        //     try 
        //     {
        //     const res = await axios.get("/api/topics/TopicsSelect")
        //     // const {id, final_closure_date} = res.data;
        //     // this.topics.id = id;
        //     // this.topics.final_closure_date = final_closure_date;
        //     // this.topics = res.data;
        //     console.log(res.data);
        //     } catch (error) {
        //         console.log(error)
        //     }
        //     // .then(response => {
        //     //     // if (response.data) {
        //     //     //     this.topics = response.data;
        //     //     //     this.topics.id = response.data;
        //     //     //     console.log(response.data);

        //     //     //     const currentTime = new Date();
        //     //     //     this.topics.forEach(topic => {
        //     //     //         const deadline = new Date(topic.final_closure_date);
        //     //     //         console.log('Deadline:', deadline);
        //     //     //         console.log('Current time:', currentTime);
        //     //     //     });
        //     //     // } else {
        //     //     //     console.error('No topics found');
        //     //     // }
        //     // });
        // },
        getCategory() {
            axios.get('/api/categories/CategoriesIndex').then(response => {
                this.categories = response.data;                
            });
        },
        sortComments: function(arr) {
            return arr.sort(function(a, b) {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            );
        }
    },
    created() {
        this.getIdeas();
        // this.getTopics();
        this.getCategory();
    }
}
</script>
<template>
    <NavBar></NavBar>
    <div class="ideasShow backgroundsu">
        <div class="container  mt-5 position-absolute start-50 translate-middle-x text-light">
            <div class="card border-light mb-4">
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
                            <tbody class="text-light text-align-center justify-content-center">
                                <tr v-for="idea in ideas">
                                    <td>{{ idea.title }}</td>
                                    <td>{{ idea.text }}</td>
                                    <td>{{ idea.file_path }}</td>
                                    <td>{{ idea.views_count }}</td> 
                                    <td>{{ idea.topics.name }}</td>
                                    <td>{{ idea.categories.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border-light mb-4">
                <div class="card-body">
                    <form @submit.prevent="handleCreateComments" method="post">
                        <div class="mb-3 row">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">
                                    <h4>Comment</h4>
                                </label>
                                <span class="col-sm-10">
                                    <input type="text" name="comments" class="form-control" v-model="form.text"
                                        placeholder="Enter Comments">
                                </span>
                            </div>
                        </div>
                        <div class="d-grid d-md-flex justify-content-md-between">
                            <div class="justify-content-md-start pb-3">
                                <div class="text-danger" v-if="isDeadlinePassed">
                                    <h5>The deadline has passed</h5>
                                </div>
                                <div v-else>
                                    <button type="submit" class="btn btn-primary mt-2"
                                        @click.prevent="handleCreateComments">Create
                                    </button>
                                </div>
                            </div>
                            <div class="justify-content-md-end pb-3">
                                <router-link :to="`/TopicsShow/${this.topics.id}`" class="btn btn-primary">
                                    Back to list</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
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
                                    </th>
                                </tr>
                                <tr>
                                    <th>Text</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody class="text-light">
                                <tr v-for="comment in sortComments(comments)" :key="ideas.id">
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