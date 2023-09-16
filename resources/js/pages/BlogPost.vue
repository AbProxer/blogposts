<template>
    <div class="blog-post" v-if="post">
        <h2>{{ post.title }}</h2>
        <h3>{{ post.subtitle }}</h3>
        <div class="post-content">{{ post.content }}</div>
        <div class="meta">
            <div class="tags">
                Tags:
                <span v-for="tag in post.tags" :key="tag">{{ tag }}</span>
            </div>
            <div class="author">Author: {{ post.author }}</div>
            <div class="date">
                Published:
                {{ new Date(post.created_at).toLocaleDateString() }}
            </div>
        </div>
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        post: Object, // Define the post prop
    },
    data() {
        return {
            post: null, // Initialize post as null
        };
    },
    created() {
        const data = this.$route.params.data;
    },
    mounted() {
        const postId = this.$route.params.id;
        this.fetchPost(postId);
    },
    methods: {
        async fetchPost(postId) {
            try {
                const response = await axios.get(`/api/post/${postId}`);
                this.post = response.data;
                console.log(response.data);
            } catch (error) {
                console.error("Error fetching post:", error);
            }
        },
    },
};
</script>

<style scoped>
/* Add styles for individual blog posts here */
</style>
