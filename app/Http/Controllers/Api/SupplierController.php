<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Image;
class SupplierController extends Controller
{
    
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'email'=>'required | unique:suppliers',
            'phone'=>'required ',
        ]);
        $data = $request->all();
        $supplier = new Supplier;
        if($request->photo){
            $exploded = explode(',',$request->photo);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg') || str_contains($exploded[0],'jpeg')  ){
                $ext = 'jpg';
            }
            else if(str_contains($exploded[0],'png')){
                $ext = 'png';
            }
            $image_name = rand(99,99999).'-employee'.'.'.$ext;
            $image_url = 'backend/image/supplier/'.$image_name;
            // file_put_contents($image_url,$decoded);
            Image::make($decoded)->resize(300, 300)->save($image_url);
            $supplier->name         = $data['name'];
            $supplier->email        = $data['email'];
            $supplier->phone        = $data['phone'];
            $supplier->address      = $data['address'];
            $supplier->shop_name    = $data['shop_name'];
            $supplier->gender       = $data['gender'];    
            $supplier->photo        = $image_url;
            $supplier->save();
        }else{
            $supplier->name         = $data['name'];
            $supplier->email        = $data['email'];
            $supplier->phone        = $data['phone'];
            $supplier->address      = $data['address'];
            $supplier->shop_name    = $data['shop_name'];
            $supplier->gender       = $data['gender'];    
            $supplier->save();
        }
    }
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'email'=>'required',
            'phone'=>'required ',
        ]);

        $supplier = array();
        $supplier['name'] = $request->name;
        $supplier['email'] = $request->email;
        $supplier['phone'] = $request->phone;
        $supplier['address'] = $request->address;
        $supplier['gender'] = $request->gender;
        $supplier['shop_name'] = $request->shop_name;
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
            $image_name = rand(99,99999).'-supplier'.'.'.$ext;
            $image_url = 'backend/image/supplier/'.$image_name;
            $success = Image::make($decoded)->resize(300,300)->save($image_url);
            if($success){
                $supplier['photo'] = $image_url;
                $supplier_info = Supplier::find($id);
                if(!empty($supplier_info->photo)){
                    unlink($supplier_info->photo);
                }else{

                }
                $supplier_info->update($supplier);
            }
        }
        else
        {
            $old_photo = $request->photo;
            $supplier['photo'] = $old_photo;
            Supplier::find($id)->update($supplier);
        }
    }
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $photo = $supplier['photo'];
        if($photo){
            unlink($photo);
            $supplier->delete();
        }else{
            $supplier->delete();
        }
    }
}
