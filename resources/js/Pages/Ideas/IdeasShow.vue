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
            ideas: [],
        }
    },
    created() {
        this.getIdeas();
    },
    //mounted() { },
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
                this.views = response.data;
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
    }
}
</script>
<template>
    <NavBar></NavBar>
    <div style="position:absolute;width:100%;justify-content:center;">
        <form @submit.prevent="handlecreateComments" method="post"> 
            <div style="width:100%;display:flex;justify-content:center">
                <div class="card categoriesindex">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Create new Ideas</h3>
                            </div>
                            <div class="col-md-6">
                                <router-link to="/TopicsIndex" class="btn btn-primary float-end">Back to list</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Comment</strong>
                                        <input type="text" name="comments" class="form-control" v-model="form.text"
                                            placeholder="Enter Comments">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2"
                                        @click.prevent="handlecreateComments">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    <div class="" style="width:100%;display:flex;justify-content:center" >
        <div class="card categoriesindex">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 catecenter" >
                        <thead style="text-align:center;align-items:center;justify-content:center">
                            <h3>Details</h3>
                            <tr>
                                <td>Tiltle</td>
                                <td>Content</td>
                                <td>File Path</td>
                                <td>View</td>
                                <td>Topic</td>
                                <td>Category</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ideas in ideas" :key="ideas.id">
                                <th>{{ ideas.title }}</th>
                                <th>{{ ideas.text }}</th>
                                <th>{{ ideas.file_path }}</th>
                                <th v-for="topics in ideas.topics" :key="topics.id">{{ topics.name }}</th>
                                <th v-for="categories in ideas.categories" :key="categories.id">{{ categories.name }}</th>
                            </tr>
                        </tbody>
                    </div>
                    <div class="col-md-6 catecenter" >
                        <router-link to="/TopicsIndex" class="btn btn-primary float-end">Back to list</router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Text</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="comments in ideas.comments" :key="ideas.id">
                            <td>{{ comments.text }}</td>
                            <td>{{ comments.created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>
    <div>
        <img src="../../../css/login.jpg" alt="" class=" backgroundsu" style=" width:100%;">
    </div>
    <TheFooter></TheFooter>
</template>