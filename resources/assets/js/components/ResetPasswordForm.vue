<template>
  <div class="p-reset-password-email">
    <div class="card card-default">
      <div class="card-header text-center ">Change password</div>
      <div class="card-body">
        <form @submit.prevent=validateBeforeSubmit>
          <div class="form-group">
            <label for="password">New password</label>
            <input
                v-validate="'required|min:3'"
                :class="{ 'border-danger text-danger' : errors.first('password')}"
                v-model="data.password"
                type="password"
                class="form-control "
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
          >Change
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ResetPasswordForm",
    data() {
      return {
        data: {},
      }
    },
    methods: {
      validateBeforeSubmit(e) {
        this.$validator.validateAll().then((result) => {
          if (result) {
            return this.$emit('changePassword', this.data);
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