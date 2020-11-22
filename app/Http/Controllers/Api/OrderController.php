<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use DateTime;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function todaysOrder(){
        $todays_date = date('d/m/Y');
        // $todays_order = Order::with('customer')->where('order_date',$todays_date)->orderBy('id','Desc')->get();
        $todays_order = DB::table('orders')
                        ->join('customers','orders.customer_id','customers.id')
                        ->where('order_date',$todays_date)
                        ->select('customers.name','orders.*')
                        ->orderBy('customers.id','desc')
                        ->get();
        return response()->json($todays_order);
    }
    public function orderDetails($id){
        $order = DB::table('orders')
                ->join('customers','orders.customer_id','customers.id')
                ->where('orders.id',$id)
                ->select('customers.name','customers.phone','customers.address','customers.gender','orders.*')
                ->first();
        return response()->json($order);
    }
    public function allOrderDetails($id){
        $order_details = DB::table('order_details')
                ->join('products','order_details.product_id','products.id')
                ->where('order_details.order_id',$id)
                ->select('products.product_name','products.product_code','products.product_image','order_details.*')
                ->get();
        return response()->json($order_details);
    }
    public function searchOrder(Request $request){
        $order_date = $request->date;
        $order_month = $request->month;
        $order_year = $request->year;
        if($order_month){
            $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.order_month',$order_month)
            ->select('customers.name','customers.phone','orders.*')
            ->get();
            return response()->json($order);
        }else if($order_date){
            $new_date = new DateTime($order_date);
            $date_format = $new_date->format('d/m/Y');
            $order = DB::table('orders')
                            ->join('customers','orders.customer_id','customers.id')
                            ->where('orders.order_date',$date_format)
                            ->select('customers.name','customers.phone','orders.*')
                            ->get();
            return response()->json($order);
        }else if($order_year){
            $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('orders.order_year',$order_year)
            ->select('customers.name','customers.phone','orders.*')
            ->get();
            return response()->json($order);
        }
    }
}
