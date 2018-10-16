<template>
  <div class="p-reset-password-email">
    <div class="card card-default">
      <div class="card-header text-center ">Reset password</div>
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
          <button
              type="submit"
              class="auth-button btn btn-default w-100"
          >Send
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ResetPasswordEmail",
    data() {
      return {
        data: {},
      }
    },
    methods: {
      validateBeforeSubmit(e) {
        this.$validator.validateAll().then((result) => {
          if (result) {
            return this.$emit('reset', this.data);
          }
        }).catch(() => {
          return false
        });
      }
    }
  }
</script>

<style scoped>

</style>