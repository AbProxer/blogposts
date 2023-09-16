<template>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Explore Our Blog</h1>
    <ul class="list-group">
      <li
        v-for="post in posts"
        :key="post.id"
        class="list-group-item mb-4 shadow p-3 mb-5 bg-white rounded"
      >
        <router-link
          :to="{ name: 'blogPost', params: { id: post.id, data: post.title } }"
          class="text-decoration-none"
        >
          <div>
            <h2 class="mb-3">{{ post.title }}</h2>
            <h3 class="mb-4 text-muted">{{ post.subtitle }}</h3>
            <div class="mb-3">
            <strong style="color: #535252">Tags: </strong>
            <span
              v-for="tag in post.tags"
              :key="tag"
              class="badge badge-pill badge-primary ml-1 mb-1"
              style="background-color: #7488ed; color: #f8f3f3; margin-right: 6px;"
            >
              {{ tag }}
            </span>
          </div>
            <div class="mb-2">
              <strong style="color: #535252">Author:</strong> {{ post.author }}
            </div>
            <div>
              <strong style="color: #535252">Published:</strong>
              {{ new Date(post.created_at).toLocaleDateString() }}
            </div>
          </div>
        </router-link>
        <button
          @click="deletePost(post.id)"
          class="btn btn-danger btn-sm float-end mt-3"
        >
          Delete
        </button>
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
                // console.log(response.data);
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
                    // console.log(`Post ${postId} deleted successfully.`);
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
