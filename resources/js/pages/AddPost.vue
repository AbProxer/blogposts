<template>
    <div class="container mt-4">
      <h2 class="text-center mb-4">Create New Post</h2>
      <!-- Success message alert -->
    <div v-if="showSuccessMessage" class="alert alert-success">
      Post created successfully!
    </div>
      <form @submit.prevent="submitPost">
        <div class="mb-3">
          <label for="title" class="form-label">Title:</label>
          <input
            type="text"
            class="form-control"
            id="title"
            v-model="newPost.title"
            required
          />
        </div>
        <div class="mb-3">
          <label for="subtitle" class="form-label">Subtitle:</label>
          <input
            type="text"
            class="form-control"
            id="subtitle"
            v-model="newPost.subtitle"
          />
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content:</label>
          <textarea
            class="form-control"
            id="content"
            v-model="newPost.post"
            required
          ></textarea>
        </div>
        <div class="mb-3">
          <label for="interviewee" class="form-label">Interviewee:</label>
          <input
            type="text"
            class="form-control"
            id="interviewee"
            v-model="newPost.interviewee"
          />
        </div>
        <div class="mb-3">
          <label for="tags" class="form-label">Tags (comma separated):</label>
          <input
            type="text"
            class="form-control"
            id="tags"
            v-model="newPost.tags"
          />
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author:</label>
          <input
            type="text"
            class="form-control"
            id="author"
            v-model="newPost.author"
            required
          />
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Create Post</button>
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
                tags: [],
                author: "",
                created_at: new Date().toISOString(),
                updated_at: new Date().toISOString(),
            },
            showSuccessMessage: false,
        };
    },
    methods: {
        async submitPost() {
            try {
                
                this.newPost.tags = this.newPost.tags.split(",").map(tag => tag.trim());
                this.newPost.created_at = this.newPost.created_at.split("T")[0];
                this.newPost.updated_at = this.newPost.updated_at.split("T")[0];

                const response = await axios.post("/api/post", this.newPost);
                // console.log("Post created successfully:", response.data);
                this.showSuccessMessage = true;

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

                setTimeout(() => {
                    this.showSuccessMessage = false;
                    this.$router.push({ name: "Posts"});
                }, 5000);

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
