//signup and login
let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;

//EMPLOYEE
let store_employee = require('./components/employee/Create.vue').default;
let employee = require('./components/employee/Index.vue').default;
let edit_employee = require('./components/employee/Edit.vue').default;
//SUPPLIER
let store_supplier = require('./components/supplier/Create.vue').default;
let supplier = require('./components/supplier/Index.vue').default;
let edit_supplier = require('./components/supplier/Edit.vue').default;
//Category
let store_category = require('./components/category/Create.vue').default;
let category = require('./components/category/Index.vue').default;
let edit_category = require('./components/category/Edit.vue').default;
//Product
let store_product = require('./components/product/Create.vue').default;
let product = require('./components/product/Index.vue').default;
let edit_product = require('./components/product/Edit.vue').default;
//home
let Home = require('./components/Home.vue').default;

/*-------Export All Routes-------*/
export const routes = [
    { path: '/', component: Login , name:'/'},
    { path: '/register', component: Register , name: 'register' },
    { path: '/forget', component: Forget , name: 'forget' },
    { path: '/home', component: Home , name: 'home' },
    { path: '/logout', component: Logout , name: 'logout' },
    //EMPLOYEE
    { path: '/store-employee', component: store_employee , name: 'store-employee' },
    { path: '/employee', component: employee , name: 'employee' },
    { path: '/edit-employee/:id', component: edit_employee , name: 'edit-employee' },
    //SUPPLIER
    { path: '/store-supplier', component: store_supplier , name: 'store-supplier' },
    { path: '/supplier', component: supplier , name: 'supplier' },
    { path: '/edit-supplier/:id', component: edit_supplier , name: 'edit-supplier' },
    //Category
    { path: '/store-category', component: store_category , name: 'store-category' },
    { path: '/category', component: category , name: 'category' },
    { path: '/edit-category/:id', component: edit_category , name: 'edit-category' },
    //Product
    { path: '/store-product', component: store_product , name: 'store-product' },
    { path: '/product', component: product , name: 'product' },
    { path: '/edit-product/:id', component: edit_product , name: 'edit-product' },
  ]