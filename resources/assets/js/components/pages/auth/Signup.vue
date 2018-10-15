<template>
  <div class="p-signup">
    <alert-error v-bind:errorMessage="errorMessage"></alert-error>
    <div class="row justify-content-center">
      <div class=" col-sm-12 col-md-6 col-lg-6">
        <reg-form
            v-on:signup="signup($event)"
        ></reg-form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: "Signup",
    data() {
      return {
        errorMessage: ''
      }
    },
    methods: {
      signup(data) {
        axios({
          method: 'post',
          url: '/api/signup',
          data: {
            name: data.name,
            email: data.email,
            password: data.password
          }
        }).then(res => {
          if (!res.data.error) {
            this.$router.push('/login');
          }
          this.errorMessage = res.data.response_text;
          setTimeout(() => {
            this.errorMessage = '';
          }, 3000)
        });
      }
    }

  }
</script>

<style scoped>
  .p-signup {
    margin: 10% 10%;
  }
</style>