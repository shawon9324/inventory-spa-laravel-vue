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
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');


Route::post('/salary/paid/{id}','Api\SalaryController@paid');
Route::get('/salary','Api\SalaryController@allSalary');
Route::get('/salary/view/{id}','Api\SalaryController@viewSalary');
Route::get('/salary/edit/{id}','Api\SalaryController@editSalary');