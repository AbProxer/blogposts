import {createWebHistory, createRouter } from 'vue-router';
import Home from './pages/Home.vue';
import Posts from './pages/Posts.vue';
import BlogPost from './pages/BlogPost.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/posts',
    name: 'Posts',
    component: Posts
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