<template>
  <div class="p-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <router-link to="/" class="navbar-brand">Logo</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item" @click="isActive = 1" :class="{active : isActive == 1}">
            <router-link to="/" class="nav-link">Home</router-link>
          </li>
          <li class="nav-item" @click="isActive = 2" :class="{active : isActive == 2}">
            <router-link to="/about" class="nav-link">About</router-link>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">{{ userInfo.name ? userInfo.name : 'sign in' }}</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <router-link to="/signup" class="dropdown-item" v-if="!getToken()">Signup</router-link>
              <router-link to="/login" class="dropdown-item" v-if="!getToken()">Login</router-link>
              <a class="dropdown-item" href="#" @click="logout()" v-if="getToken()">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "Nav",
    data() {
      return {
        isActive: 1,
        userInfo: {},
      }
    },
    methods: {
      logout() {
        localStorage.removeItem('authorization');
        this.userInfo.name = '';
        this.$router.push('/login');
      },
      user() {
        if (localStorage.getItem('authorization')) {
          axios({
            method: 'get',
            url: '/api/auth/user',
          }).then(res => {
            this.userInfo = res.data.data;
          });
        }
      },
      getToken() {
        return localStorage.getItem('authorization');
      }
    },
    mounted() {
      this.user();
    },
    created() {
      const $ = this;
      this.$root.$on('showName', () => {
        $.user();
      });
    }
  }
</script>

<style scoped>
  .p-navbar {
    margin-bottom: 10px;
  }
</style>