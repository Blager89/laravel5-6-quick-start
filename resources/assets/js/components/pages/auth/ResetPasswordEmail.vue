<template>
  <div class="p-reset-email-form">
    <alert-error
        v-bind:errorMessage="errorMessage"
    ></alert-error>
    <div class="row justify-content-center">
      <div class=" col-sm-12 col-md-8 col-lg-6">
        <reset-email-form
            v-on:reset="reset($event)"
        ></reset-email-form>
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
        errorMessage: ''
      }
    },
    methods:{
      reset(data) {
        axios({
          method: 'post',
          url: '/api/reset/password/email',
          data: {
            email: data.email,
          }
        }).then(res => {
          if (!res.data.error) {
            this.$router.push('/login')
          }else{
            this.errorMessage = res.data.response_text;
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
.p-reset-email-form{
  margin: 10% 10%;
}
</style>