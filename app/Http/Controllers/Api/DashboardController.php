<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
class DashboardController extends Controller
{
    public function todayInfo(){
        $date = date('d/m/Y');
        $date_expense = date('Y-m-d');
        $day = date('d');
        $month = date('F');
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
                                ->where('expense_date',$date_expense)
                                ->sum('amount');
        $products = DB::table('products')
                                ->where('product_quantity','<','1')
                                ->get();
        return response()->json(['sell'=>$todays_sell,'income'=>$todays_income,'due'=>$todays_due,'expense'=>$todays_expense,'products'=>$products,'day'=>$day,'month'=>$month]);
    }
    public function topSellProduct(){
        $new = DB::table('order_details')
                    ->join('products','order_details.product_id','products.id')
                    ->distinct()->orderBy('products.id')->pluck('products.id');
        $data = array();
        //TOTAL SELL PRODUCT COUNTS AND GENERATE NEW ARRARY
        for ($i=0; $i < count($new); $i++) { 
            $data[$i] = [
                'id' => $new[$i],
                'product_name' => DB::table('products')->select('products.product_name')->where('products.id',$new[$i])->value('product_name'),
                'stock' => DB::table('products')->select('products.product_quantity')->where('products.id',$new[$i])->value('product_quantity'),
                'qty' =>  DB::table('order_details')
                            ->join('products','order_details.product_id','products.id')
                            ->select('products.id','order_details.pro_qty')
                            ->where('products.id',$new[$i])
                            ->sum('pro_qty'),
            ];
        }
        //FULL ARRARY SORTING
        for($i=0; $i< count($data); $i++)
        {
            for($j=$i+1; $j< count($data); $j++)
            {
                if($data[$j]['qty'] >$data[$i]['qty'])
                {
                    $tmp[$i]['id'] = $data[$i]['id'];
                    $tmp[$i]['product_name'] = $data[$i]['product_name'];
                    $tmp[$i]['qty'] = $data[$i]['qty'];
                    $tmp[$i]['stock'] = $data[$i]['stock'];

                    $data[$i]['id'] = $data[$j]['id'];
                    $data[$i]['product_name'] = $data[$j]['product_name'];
                    $data[$i]['stock'] = $data[$j]['stock'];
                    $data[$i]['qty'] = $data[$j]['qty'];

                    $data[$j]['id'] = $tmp[$i]['id'];
                    $data[$j]['product_name'] =  $tmp[$i]['product_name'] ;
                    $data[$j]['stock'] =  $tmp[$i]['stock'] ;
                    $data[$j]['qty'] = $tmp[$i]['qty'];
                }
            }
        }
        array_splice(($data), 5);
        return response()->json($data);

    }
}
