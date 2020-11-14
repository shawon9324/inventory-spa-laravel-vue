//signup and login
let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;

//employee
let Create = require('./components/employee/Create.vue').default;
//home
let Home = require('./components/Home.vue').default;

/*-------Export All Routes-------*/
export const routes = [
    { path: '/', component: Login , name:'/'},
    { path: '/register', component: Register , name: 'register' },
    { path: '/forget', component: Forget , name: 'forget' },
    { path: '/home', component: Home , name: 'home' },
    { path: '/logout', component: Logout , name: 'logout' },
    { path: '/store-employee', component: Create , name: 'store-employee' },
  ]