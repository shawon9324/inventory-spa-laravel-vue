<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
class DashboardController extends Controller
{
    public function todaySell(){
        $date = date('d/m/Y');
        $todays_sell_amount = DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('total');
        return response()->json($todays_sell_amount);
    }
    public function todayIncome(){
        $date = date('d/m/Y');
        $todays_income_amount = DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('pay');
        return response()->json($todays_income_amount);
    }
    public function todayDue(){
        $date = date('d/m/Y');
        $todays_due_amount = DB::table('orders')
                                ->where('order_date',$date)
                                ->sum('due');
        return response()->json($todays_due_amount);
    }
    public function todayExpense(){
        $date = date('d/m/Y');
        $todays_expense_amount = DB::table('expenses')
                                ->where('expense_date',$date)
                                ->sum('amount');
        return response()->json($todays_expense_amount);
    }
    public function stockOut(){
        $date = date('d/m/Y');
        $products = DB::table('products')
                        ->where('product_quantity','<','1')
                         ->get();
        return response()->json($products);
    }
}
