import {createWebHistory, createRouter } from 'vue-router';
import Posts from './pages/Posts.vue';
import BlogPost from './pages/BlogPost.vue';
import AddPost from './pages/AddPost.vue';


const routes = [
  {
    path: '/',
    name: 'Posts',
    component: Posts
  },
  {
    path: '/new-post',
    name: 'AddPost',
    component: AddPost
  },
  {
    path: '/post/:id',
    name: 'blogPost',
    component: BlogPost,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;