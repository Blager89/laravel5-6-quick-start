<template>
  <div class="p-login-form">
    <div class="card card-default">
      <div class="card-header text-center ">Login</div>
      <div class="card-body">
        <form @submit.prevent=validateBeforeSubmit>
          <div class="form-group">
            <label for="email">Email</label>
            <input
                v-validate="'required|email'"
                :class="{ 'border-danger text-danger' : errors.first('email')}"
                v-model="data.email"
                type="email"
                class="form-control "
                id="email"
                name="email"
                aria-describedby="emailHelp"
                placeholder="Enter email"
            >
            <small class="text-danger">{{ errors.first('email') }}</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
                v-validate="'required|min:3'"
                :class="{ 'border-danger text-danger' : errors.first('password')}"
                v-model="data.password"
                type="password"
                class="form-control"
                id="password"
                name="password"
                aria-describedby="passwordHelp"
                placeholder="Enter password"
            >
            <small class="text-danger">{{ errors.first('password') }}</small>
          </div>
          <button
              type="submit"
              class="auth-button btn btn-default w-100"
          >Submit
          </button>
          <div class="link-button pt-4 d-block text-center">
            <router-link to="/signup">registration</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Form",
    data() {
      return {
        data: {},
      }
    },
    methods: {
      validateBeforeSubmit(e) {
        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$emit('login', this.data);
            return
          }
        }).catch(() => {
          return false
        });
      },
    }
  }
</script>

<style scoped>
</style>