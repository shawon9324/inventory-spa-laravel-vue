<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;
use Image;
class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'email'=>'required | unique:customers',
            'phone'=>'required ',
        ]);
        $data = $request->all();
        $customer = new Customer;
        if($request->photo){
            $exploded = explode(',',$request->photo);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg') || str_contains($exploded[0],'jpeg')  ){
                $ext = 'jpg';
            }
            else if(str_contains($exploded[0],'png')){
                $ext = 'png';
            }
            $image_name = rand(99,99999).'-customer'.'.'.$ext;
            $image_url = 'backend/image/customer/'.$image_name;
            Image::make($decoded)->resize(300, 300)->save($image_url);
            $customer->name         = $data['name'];
            $customer->email        = $data['email'];
            $customer->phone        = $data['phone'];
            $customer->address      = $data['address'];
            $customer->gender       = $data['gender'];    
            $customer->photo        = $image_url;
            $customer->save();
        }else{
            $customer->name         = $data['name'];
            $customer->email        = $data['email'];
            $customer->phone        = $data['phone'];
            $customer->address      = $data['address'];
            $customer->gender       = $data['gender'];    
            $customer->save();
        }
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'phone'=>'required ',
        ]);
        $customer = array();
        $customer['name'] = $request->name;
        $customer['email'] = $request->email;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $customer['gender'] = $request->gender;
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
            $image_name = rand(99,99999).'-customer'.'.'.$ext;
            $image_url = 'backend/image/customer/'.$image_name;
            $success = Image::make($decoded)->resize(300,300)->save($image_url);
            if($success){
                $customer['photo'] = $image_url;
                $customer_info = Customer::find($id);
                if(!empty($customer_info->photo)){
                    unlink($customer_info->photo);
                }else{

                }
                $customer_info->update($customer);
            }
        }
        else
        {
            $old_photo = $request->photo;
            $customer['photo'] = $old_photo;
            Customer::find($id)->update($customer);
        }


    }
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $photo = $customer['photo'];
        if($photo){
            unlink($photo);
            $customer->delete();
        }else{
            $customer->delete();
        }
       
    }
}
