<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
class DashboardController extends Controller
{
    public function todayInfo(){
        $date = date('d/m/Y');
        $todays_sell =   DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('total');
        $todays_income = DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('pay');        
        $todays_due =    DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('due');
        $todays_expense = DB::table('expenses')
                                ->where('expense_date',$date)
                                ->sum('amount');
        $products = DB::table('products')
                        ->where('product_quantity','<','1')
                         ->get();
        return response()->json(['sell'=>$todays_sell,'income'=>$todays_income,'due'=>$todays_due,'expense'=>$todays_expense,'products'=>$products]);
    }
    public function stockOut(){
        $date = date('d/m/Y');
        $products = DB::table('products')
                        ->where('product_quantity','<','1')
                         ->get();
        return response()->json($products);
    }
}
