<template>
    <div class="blog">
        <h1>Blog Posts</h1>
        <ul>
            <li v-for="post in posts" :key="post.id" class="blog-post">
                <router-link :to="{ name: 'blogPost', params: { id: post.id, data: post.title } }" >
                    <h2>{{ post.title }}</h2>
                    <h3>{{ post.subtitle }}</h3>
                    <div class="post-content">{{ post.post }}</div>
                    <div class="meta">
                        <div class="tags">
                            Tags:
                            <span v-for="tag in post.tags" :key="tag">{{
                                tag
                            }}</span>
                        </div>
                        <div class="author">Author: {{ post.author }}</div>
                        <div class="date">
                            Published:
                            {{ new Date(post.created_at).toLocaleDateString() }}
                        </div>
                        <button @click="deletePost(post.id)">Delete</button>
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts() {
            try {
                const response = await axios.get("/api/posts");
                this.posts = response.data;
                console.log(response.data);
            } catch (error) {
                console.error("Error fetching posts:", error);
            }
        },
        async deletePost(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                try {
                    await axios.delete(`/api/post/${postId}`);
                    // Remove the deleted post from the local list
                    this.posts = this.posts.filter((post) => post.id !== postId);
                    console.log(`Post ${postId} deleted successfully.`);
                } catch (error) {
                    console.error(`Error deleting post ${postId}:`, error);
                }
            }
        },
    },
};
</script>

<style scoped>
.blog {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.blog h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.blog-post {
    margin-bottom: 40px;
    border: 1px solid #ddd;
    padding: 20px;
    background-color: #f9f9f9;
}

.blog-post h2 {
    font-size: 24px;
    margin-top: 0;
}

.blog-post h3 {
    font-size: 18px;
    color: #666;
}

.post-content {
    margin-top: 10px;
}

.meta {
    margin-top: 20px;
    font-size: 14px;
    color: #777;
}

.tags span {
    margin-right: 5px;
    color: #333;
}

.author {
    margin-right: 10px;
}

.date {
    margin-right: 10px;
}
</style>
