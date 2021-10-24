/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import Vue from "vue";

 require('./bootstrap');
 
 window.Vue = require('vue').default;
 
 import router from './router';
 import store from './store';
 import  './axios';
 import App from './App.vue';
 
 Vue.mixin(require('./asset'));
 Vue.component('app', require('./App.vue').default);
 
 const app = new Vue({
     store,
     el: '#app',
     components: { App },
     router,
  });