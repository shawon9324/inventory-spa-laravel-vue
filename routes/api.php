<?php
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');

});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/customer','Api\CustomerController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');


Route::post('/salary/paid/{id}','Api\SalaryController@paid');
Route::get('/salary/session/{id}','Api\SalaryController@allSalary');
Route::get('/salary/view/{year}/{month}','Api\SalaryController@viewSalary');
Route::get('/salary/edit/{id}','Api\SalaryController@editSalary');
Route::post('/salary/update/{id}','Api\SalaryController@updateSalary');

Route::get('/salary','Api\SalaryController@allSession');

Route::post('/stock/update/{id}','Api\ProductController@updateStock');

Route::get('/getting/product/{id}','Api\PosController@getProduct');

Route::post('/addToCart/{id}','Api\CartController@addToCart');
Route::get('/cart/product','Api\CartController@cartProduct');
Route::post('/cart/remove/{id}','Api\CartController@removeCartItem');
Route::post('/increment/{id}','Api\CartController@increment');
Route::post('/decrement/{id}','Api\CartController@decrement');


Route::get('/vat','Api\CartController@vat');
Route::post('/orderdone','Api\PosController@orderDone');

Route::get('/orders','Api\OrderController@todaysOrder');
Route::get('/order/details/{id}','Api\OrderController@orderDetails');
Route::get('/order/orderdetails/{id}','Api\OrderController@allOrderDetails');

Route::post('/search/order','Api\OrderController@searchOrder');

//DASHBOARD FUNCTIONALITY
Route::get('/today/sell','Api\DashboardController@todaySell');
Route::get('/today/income','Api\DashboardController@todayIncome');
Route::get('/today/due','Api\DashboardController@todayIncome');
Route::get('/today/expense','Api\DashboardController@todayExpense');
Route::get('/stockout','Api\DashboardController@stockOut');
