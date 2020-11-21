<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Orderdetail;
use App\Model\Pointofsell;
use App\Model\Product;
use Illuminate\Http\Request;
use DB;
class PosController extends Controller
{
    public function getProduct($id){
        $product = Product::where('category_id',$id)->get();
        return response()->json($product);
    }
    public function orderDone(Request $request){
        $validateData = $request->validate([
            'customer_id' => 'required',
            'payby' =>'required',
        ]);
        $data = array();
        $data['customer_id']        = $request->customer_id;
        $data['qty']                = $request->qty;
        $data['sub_total']          = $request->sub_total;
        $data['vat']                = $request->vat;
        $data['total']              = $request->total;
        $data['pay']                = $request->pay;
        $data['due']                = ($request->total-$request->pay);
        $data['payby']              = $request->payby;
        $data['order_date']         = date('d/m/Y');
        $data['order_month']        = date('F');
        $data['order_year']         = date('Y');
        $order_id = Order::insertGetId($data);
        $contents = Pointofsell::all();
        foreach ($contents as $content) {
            $orderData['order_id'] = $order_id;
            $orderData['product_id'] = $content->pro_id;
            $orderData['pro_qty'] = $content->pro_qty;
            $orderData['pro_price'] = $content->pro_price;
            $orderData[ 'sub_total'] = $content->sub_total;
            Orderdetail::insert($orderData);
            Product::where('id',$content->pro_id)->update(['product_quantity' => DB::raw('product_quantity -'.$content->pro_qty)]);
        }
        Pointofsell::truncate();

    }
}
