<template>
    <div>
        <router-link :to="{name :'Home'}">Home</router-link> |
        <router-link :to="{name :'Posts'}">Posts</router-link> |


        <router-view></router-view>
    </div>
</template>