<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Image;
class ProductController extends Controller
{
    
    public function index()
    {
        $product = Product::with('category','supplier')->get();
        return response()->json($product);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_code' => 'required | unique:products',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
            
        ]);
        $data = $request->all();
        $product = new Product;
        if($request->product_image){
            $exploded = explode(',',$request->product_image);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg') || str_contains($exploded[0],'jpeg')  ){
                $ext = 'jpg';
            }
            else if(str_contains($exploded[0],'png')){
                $ext = 'png';
            }
            $image_name = rand(99,99999).'-product'.'.'.$ext;
            $image_url = 'backend/image/product/'.$image_name;
            Image::make($decoded)->resize(300, 300)->save($image_url);
            $product->category_id           = $data['category_id'];
            $product->supplier_id           = $data['supplier_id'];
            $product->product_code          = $data['product_code'];
            $product->product_name          = $data['product_name'];
            $product->product_details       = $data['product_details'];
            $product->buying_price          = $data['buying_price'];    
            $product->selling_price         = $data['selling_price'];    
            $product->buying_date           = $data['buying_date'];    
            $product->product_quantity      = $data['product_quantity'];    
            $product->root                  = $data['root'];    
            $product->product_image         = $image_url;
            $product->save();
        }else{
            $product->category_id           = $data['category_id'];
            $product->supplier_id           = $data['supplier_id'];
            $product->product_code          = $data['product_code'];
            $product->product_name          = $data['product_name'];
            $product->product_details       = $data['product_details'];
            $product->buying_price          = $data['buying_price'];    
            $product->selling_price         = $data['selling_price'];    
            $product->buying_date           = $data['buying_date'];    
            $product->product_quantity      = $data['product_quantity'];   
            $product->root                  = $data['root'];     
            $product->save();
        }
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);
        $product = array();
        $product['category_id']         = $request->category_id;
        $product['supplier_id']         = $request->supplier_id;
        $product['product_code']        = $request->product_code;
        $product['product_details']     = $request->product_details;
        $product['buying_price']        = $request->buying_price;
        $product['selling_price']       = $request->selling_price;
        $product['buying_date']         = $request->buying_date;
        $product['product_quantity']    = $request->product_quantity;
        $product['buying_date']         = $request->buying_date;
        $product['root']                = $request->root;
        $image = $request->new_photo;
        if($image)
        {
            $exploded = explode(',',$image);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg') || str_contains($exploded[0],'jpeg')  ){
                $ext = 'jpg';
            }
            else if(str_contains($exploded[0],'png')){
                $ext = 'png';
            }
            $image_name = rand(99,99999).'-product'.'.'.$ext;
            $image_url = 'backend/image/product/'.$image_name;
            $success = Image::make($decoded)->resize(300,300)->save($image_url);
            if($success){
                $product['product_image'] = $image_url;
                $product_info = Product::find($id);
                if(!empty($product_info->product_image)){
                    unlink($product_info->product_image);
                }else{

                }
                $product_info->update($product);
            }
        }
        else
        {
            $old_photo = $request->product_image;
            $product['product_image'] = $old_photo;
            Product::find($id)->update($product);
        }
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $photo = $product['product_image'];
        if($photo){
            unlink($photo);
            $product->delete();
        }else{
            $product->delete();
        }
    }
    public function updateStock(Request $request, $id){
        $validateData = $request->validate([
            'product_quantity' => 'required'
        ]);
        $data = array();
        $data['product_quantity'] = $request->product_quantity;
        Product::find($id)->update($data);

    }
}
