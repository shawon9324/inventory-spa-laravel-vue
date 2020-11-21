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
//CUSTOMER
let store_customer = require('./components/customer/Create.vue').default;
let customer = require('./components/customer/Index.vue').default;
let edit_customer = require('./components/customer/Edit.vue').default;
//Category
let store_category = require('./components/category/Create.vue').default;
let category = require('./components/category/Index.vue').default;
let edit_category = require('./components/category/Edit.vue').default;
//Product
let store_product = require('./components/product/Create.vue').default;
let product = require('./components/product/Index.vue').default;
let edit_product = require('./components/product/Edit.vue').default;
//Product
let store_expense = require('./components/expense/Create.vue').default;
let expense = require('./components/expense/Index.vue').default;
let edit_expense = require('./components/expense/Edit.vue').default;
//Salary
let given_salary = require('./components/salary/AllEmployee.vue').default;
let pay_salary = require('./components/salary/Create.vue').default;
let salary_year = require('./components/salary/SalarySession.vue').default;
let view_salary = require('./components/salary/View.vue').default;
let update_salary = require('./components/salary/Edit.vue').default;
let salary_session = require('./components/salary/Index.vue').default;
//product stock
let stock = require('./components/stock/Stock.vue').default;
let edit_stock = require('./components/stock/Edit.vue').default;
//POS [ POINT OF SELL]
let pos = require('./components/pos/PointOfSell.vue').default;
//ORDER
let order = require('./components/order/Order.vue').default;
let view_order = require('./components/order/ViewOrder.vue').default;
//Search Order
let search_order = require('./components/order/SearchOrder.vue').default;

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
    //Customer
    { path: '/store-customer', component: store_customer , name: 'store-customer' },
    { path: '/customer', component: customer , name: 'customer' },
    { path: '/edit-customer/:id', component: edit_customer , name: 'edit-customer' },
    //Category
    { path: '/store-category', component: store_category , name: 'store-category' },
    { path: '/category', component: category , name: 'category' },
    { path: '/edit-category/:id', component: edit_category , name: 'edit-category' },
    //Product
    { path: '/store-product', component: store_product , name: 'store-product' },
    { path: '/product', component: product , name: 'product' },
    { path: '/edit-product/:id', component: edit_product , name: 'edit-product' },
    //Expense
    { path: '/store-expense', component: store_expense , name: 'store-expense' },
    { path: '/expense', component: expense , name: 'expense' },
    { path: '/edit-expense/:id', component: edit_expense , name: 'edit-expense' },
    //Salary
    { path: '/given-salary', component: given_salary , name: 'given-salary' },
    { path: '/pay-salary/:id', component: pay_salary , name: 'pay-salary' },
    { path: '/view-salary/:id/:id2', component: view_salary , name: 'view-salary' },
    { path: '/update-salary/:id', component: update_salary , name: 'update-salary' },
    { path: '/salary', component: salary_session , name: 'salary' },
    { path: '/salary/:id', component: salary_year , name: 'salary-year' },
    //PRODUCT STOCK
    { path: '/stock', component: stock , name: 'stock' },
    { path: '/edit-stock/:id', component: edit_stock , name: 'edit-stock' },
    //POS [ POINT OF SELL]
    { path: '/pos', component: pos , name: 'pos' },
    // Order
    { path: '/order', component: order , name: 'order' },
    { path: '/view-order/:id', component: view_order , name: 'view-order' },
    //Search Order
    { path: '/search/order', component: search_order , name: 'search-order' },
  ]