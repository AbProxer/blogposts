<template>
    <div class="container mt-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <div class="navbar-brand">Our Posts</div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'Posts' }" :class="{ 'active': isRouteActive('Posts') }">All Posts</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'AddPost' }" :class="{ 'active': isRouteActive('AddPost') }">Add New Post</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  
      <router-view></router-view>
    </div>
  </template>
  
  <style>
  .active {
    background-color: #5ab9c1 !important;
    color: white !important;
  }
  </style>
  
  <script>
  export default {
    methods: {
      isRouteActive(routeName) {
        return this.$route.name === routeName;
      },
    },
  };
  </script>
  