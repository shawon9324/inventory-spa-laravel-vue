<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Pointofsell;
use App\Model\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request,$id){
        $product = Product::where('id',$id)->first();
        $check = Pointofsell::where('pro_id',$id)->count();
        if($check>0){
            Pointofsell::where('pro_id',$id)->increment('pro_qty');
            $pro = Pointofsell::where('pro_id',$id)->first();
            $sub_total = ($pro->pro_qty * $pro->pro_price);
            Pointofsell::where('pro_id',$id)->update(['sub_total'=>$sub_total]);
        }else{
            $data = array();
            $data['pro_id']    = $id;
            $data['pro_name']    = $product->product_name;
            $data['pro_qty']    = 1;
            $data['pro_price']  = $product->selling_price;
            $data['sub_total']    = $product->selling_price;
            Pointofsell::insert($data);
        }
        
    }
    public function cartProduct(){
        $cart_product = Pointofsell::get();
        return response()->json($cart_product);
    }
    public function removeCartItem($id){
       Pointofsell::find($id)->delete();
    }
    public function increment($id){
        Pointofsell::where('id',$id)->increment('pro_qty');
        $product = Pointofsell::where('id',$id)->first();
        $sub_total = ($product->pro_qty * $product->pro_price);
        Pointofsell::find($id)->update(['sub_total'=>$sub_total]);
    }
    public function decrement($id){
        Pointofsell::where('id',$id)->decrement('pro_qty');
        $product = Pointofsell::where('id',$id)->first();
        $sub_total = ($product->pro_qty * $product->pro_price);
        Pointofsell::find($id)->update(['sub_total'=>$sub_total]);
    }
}
