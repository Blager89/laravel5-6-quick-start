<template>
  <div class="p-alert-error">
    <div class="row justify-content-center"
         v-if="errorMessage"
    >
      <div class=" col-sm-12 col-md-6 col-lg-6">
        <div class="alert d-block text-center"
             :class="[error ? 'alert-danger' : 'alert-success']">
          {{errorMessage}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ErrorAlert",
    props: [
      'errorMessage',
      'error'
    ]
  }
</script>

<style scoped>

</style>