<template>
  <div v-if="post" class="container">
    <div class="row">
      <div class="col-md-8">
        <h2 class="mt-4">{{ post.title }}</h2>
        <h4 class="mt-4">{{ post.subtitle }}</h4>
        <div class="mt-3">{{ post.content }}</div>
        <div class="mt-4">
          <div>
            <strong> Tags:  </strong> 
            <span v-for="tag in post.tags" :key="tag" 
            class="badge badge-primary ml-1"
            style="background-color: #5ab9c1; color: #ffffff; margin-right: 6px;"
            >
              {{ tag }}
            </span>
          </div>
          <div class="mt-3"><strong>Author:  </strong> {{ post.author }}</div>
          <div class="mt-3">
            <strong>Published: </strong> {{ new Date(post.created_at).toLocaleDateString() }}
          </div>
          <div class="mt-3">{{ post.post }}</div>
          <div class="mt-3">
            <strong>Interviewee:  </strong> {{ post.interviewee }}
          </div>
        </div>
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
