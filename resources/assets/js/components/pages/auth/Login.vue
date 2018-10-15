<template>
  <div class="p-login">
    <alert-error v-bind:errorMessage="errorMessage"></alert-error>
    <div class="row justify-content-center">
      <div class=" col-sm-12 col-md-6 col-lg-6">
        <login-form
            v-on:login="login($event)"
        ></login-form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "Login",
    data() {
      return {
        errorMessage: ''
      }
    },
    methods: {
      login(data) {
        axios({
          method: 'post',
          url: '/api/login',
          data: {
            email: data.email,
            password: data.password
          }
        }).then(res => {
          if (res.data.token) {
            localStorage.setItem('authorization', res.data.token);
            this.$root.$emit('showName');
            this.$router.push('/');
          }
        }).catch(err => {
          if (err.response.status === 401) {
            this.errorMessage = 'Invalid credentials';
            setTimeout(() => {
              this.errorMessage = '';
            }, 3000);
          }
        });
      },
    }
  }
</script>

<style scoped>
  .p-login {
    margin: 10% 10%;
  }
</style>