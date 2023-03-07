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

        }
    },
    created() {
        this.getIdeas();

    },
    mounted() { },
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
    <div class="" style="position:absolute;width:100%;justify-content:center;display:flex">
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

                        <tbody class="catetbody">
                            <!-- <tr v-for="ideas, topics, categories in ideas, ideas.topics, ideas.categories">
                                                            <th>{{ ideas.title }}</th>
                                                            <th>{{ ideas.text }}</th>
                                                            <th>{{ ideas.file_path }}</th>
                                                            <th>{{ topics.name }}</th>
                                                            <th>{{ categories.name }}</th>
                                                        </tr> -->
                            <!-- ...... -->
                            <tr v-for="ideas in ideas" :key="ideas.id">
                                <th>{{ ideas.title }}</th>
                                <th>{{ ideas.text }}</th>
                                <th>{{ ideas.file_path }}</th>
                                <th v-for="topics in ideas.topics" :key="topics.id">{{ topics.name }}</th>
                                <th v-for="categories in ideas.categories" :key="categories.id">{{ categories.name }}</th>
                            </tr>


                            <!-- -------- -->
                            <!-- <tr v-for="views in ideas.views">
                                                                                                <th>{{ views. }}</th>
                                                                                            </tr> -->
                            <!-- <tr v-for="topics in ideas.topics" :key="ideas.id">
                                        <th>{{ topics.name }}</th>
                                    </tr>
                                    <tr v-for="categories in ideas.categories" :key="ideas.id">
                                        <th>{{ categories.name }}</th>
                                    </tr> -->
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
    <TheFooter></TheFooter>
</template>