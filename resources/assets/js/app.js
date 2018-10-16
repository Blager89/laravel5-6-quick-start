/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import axios from 'axios'
import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';

Vue.component('home', require('./components/pages/Home.vue'));
Vue.component('about', require('./components/pages/About.vue'));
Vue.component('navbar', require('./components/partisals/Nav.vue'));
Vue.component('login', require('./components/pages/auth/Login.vue'));
Vue.component('signup', require('./components/pages/auth/Signup.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('reg-form', require('./components/RegForm.vue'));
Vue.component('reset-email-form', require('./components/ResetEmailForm.vue'));
Vue.component('reset-password-form', require('./components/ResetPasswordForm.vue'));
Vue.component('alert-error', require('./components/AlertError.vue'));

let Home = require('./components/pages/Home.vue');
let About = require('./components/pages/About.vue');
let Login = require('./components/pages/auth/Login.vue');
let Signup = require('./components/pages/auth/Signup.vue');
let ResetEmailPassword = require('./components/pages/auth/ResetPasswordEmail.vue');
let ResetPassword = require('./components/pages/auth/ResetPassword.vue');

Vue.use(VeeValidate);
Vue.use(VueRouter);

const router = new VueRouter({
  routes: [
    {path: '/', component: Home},
    {path: '/about', component: About},
    {path: '/login', component: Login},
    {path: '/signup', component: Signup},
    {path: '/reset/email', component: ResetEmailPassword},
    {path: '/reset/password', component: ResetPassword},
  ]
});

axios.interceptors.request.use(function (config) {
  config.headers.authorization = "bearer " + localStorage.getItem("authorization");
  return config;
}, function (error) {
  return Promise.reject(error);
});
const app = new Vue({
  el: '#app',
  router: router


});
