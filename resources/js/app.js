
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

/*-------Import All Routes------*/
import {routes} from './routes';

/*-------Import User Class------*/
import User from './Helpers/User'
window.User = User

/*-------Import Notification Class------*/
import Notification from './Helpers/Notification'
window.Notification = Notification

/*-------SWEETALERT 2------*/
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast
window.Reload = new Vue();
const router = new VueRouter({
    mode: 'history', //to remove # in the url
    routes // short for `routes: routes`
})

  

const app = new Vue({
    el: '#app',
    router,
});
