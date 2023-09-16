<template>
    <div class="create-post">
        <h2>Create New Post</h2>
        <form @submit.prevent="submitPost">
            <div class="form-group">
                <label for="title">Title:</label>
                <input
                    type="text"
                    id="title"
                    v-model="newPost.title"
                    required
                />
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle:</label>
                <input type="text" id="subtitle" v-model="newPost.subtitle" />
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea
                    id="content"
                    v-model="newPost.content"
                    required
                ></textarea>
            </div>
            <div class="form-group">
                <label for="interviewee">Interviewee:</label>
                <input
                    type="text"
                    id="interviewee"
                    v-model="newPost.interviewee"
                />
            </div>
            <div class="form-group">
                <label for="tags">Tags (comma separated):</label>
                <input type="text" id="tags" v-model="newPost.tags" />
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input
                    type="text"
                    id="author"
                    v-model="newPost.author"
                    required
                />
            </div>
            <div class="form-group">
                <button type="submit">Create Post</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { v4 as uuidv4 } from "uuid";

export default {
    data() {
        return {
            newPost: {
                id: uuidv4(),
                title: "",
                subtitle: "",
                content: "",
                interviewee: "",
                tags: "",
                author: "",
                created_at: new Date().toISOString(),
                updated_at: new Date().toISOString(),
            },
        };
    },
    methods: {
        async submitPost() {
            try {
                
                this.newPost.tags = this.newPost.tags.split(",").map(tag => tag.trim());
                this.newPost.created_at = this.newPost.created_at.split("T")[0];
                this.newPost.updated_at = this.newPost.updated_at.split("T")[0];

                const response = await axios.post("/api/post", this.newPost);
                console.log("Post created successfully:", response.data);

                // Optionally, you can navigate to the newly created post's page.
                // Example:
                // this.$router.push({ name: "post", params: { id: response.data.id } });

                // Clear the form after successful submission.
                this.newPost = {
                    title: "",
                    subtitle: "",
                    content: "",
                    interviewee: "",
                    tags: "",
                    author: "",
                };
            } catch (error) {
                console.error("Error creating post:", error);
            }
        },
    },
};
</script>

<style scoped>
/* Add styles for the CreatePost component here */
</style>
