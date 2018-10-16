<template>
  <div class="p-reset-email-form">
    <alert-error
        v-bind:errorMessage="errorMessage"
        v-bind:error="error"
    ></alert-error>
    <div class="row justify-content-center">
      <div class=" col-sm-12 col-md-8 col-lg-6">
        <reset-password-form
            v-on:changePassword="changePassword($event)"
        ></reset-password-form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "ResetPasswordEmail",
    data() {
      return {
        errorMessage: '',
        error: ''
      }
    },
    methods: {
      changePassword(data) {
        axios({
          method: 'post',
          url: '/api/auth/reset/password',
          data: {
            password: data.password,
            token: localStorage.getItem('authorization')
          }
        }).then(res => {
          if (!res.data.error) {
            this.alertMessage(res.data.response_text, res.data.error);
          } else {
            this.alertMessage(res.data.response_text, res.data.error)
          }
        });
      },
      alertMessage(data, error = null) {
        this.errorMessage = data;
        this.error = error;
        setTimeout(() => {
          this.errorMessage = '';
          this.error = '';
        }, 3000);
      }
    }

  }
</script>

<style scoped>
  .p-reset-email-form {
    margin: 10% 10%;
  }
</style>