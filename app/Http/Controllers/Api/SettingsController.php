<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Extra;
use Illuminate\Http\Request;
use Image;
class SettingsController extends Controller
{
    
    public function index()
    {
        $storeInfo = Extra::all();
        return response()->json($storeInfo);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $storeInfo = new Extra;
        if($request->logo){
            $exploded = explode(',',$request->logo);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg') || str_contains($exploded[0],'jpeg')  ){
                $ext = 'jpg';
            }
            else if(str_contains($exploded[0],'png')){
                $ext = 'png';
            }
            $image_name = rand(99,99999).'-settings'.'.'.$ext;
            $image_url = 'backend/image/settings/'.$image_name;
            Image::make($decoded)->resize(300, 300)->save($image_url);
            $storeInfo->store_name    = $data['store_name'];
            $storeInfo->email        = $data['email'];
            $storeInfo->phone        = $data['phone'];
            $storeInfo->address      = $data['address'];
            $storeInfo->vat          = $data['vat'];
            $storeInfo->logo        = $image_url;
            $storeInfo->save();
        }else{
            $storeInfo->store_name    = $data['store_name'];
            $storeInfo->email        = $data['email'];
            $storeInfo->phone        = $data['phone'];
            $storeInfo->address      = $data['address'];
            $storeInfo->vat          = $data['vat'];
            $storeInfo->save();
        }
    }
    public function show($id)
    {
        $storeInfo = Extra::find($id);
        return response()->json($storeInfo);
    }
    public function update(Request $request, $id)
    {
        $storeInfo = array();
        $storeInfo['store_name'] = $request->store_name;
        $storeInfo['email'] = $request->email;
        $storeInfo['phone'] = $request->phone;
        $storeInfo['address'] = $request->address;
        $storeInfo['vat'] = $request->vat;
        $image = $request->new_logo;
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
            $image_name = rand(99,99999).'-settings'.'.'.$ext;
            $image_url = 'backend/image/settings/'.$image_name;
            $success = Image::make($decoded)->resize(300,300)->save($image_url);
            if($success){
                $storeInfo['logo'] = $image_url;
                $storeInfo_id = Extra::find($id);
                if(!empty($storeInfo_id->logo)){
                    unlink($storeInfo_id->logo);
                }else{

                }
                $storeInfo_id->update($storeInfo);
            }
        }
        else
        {
            $old_logo = $request->logo;
            $storeInfo['logo'] = $old_logo;
            Extra::find($id)->update($storeInfo);
        }
    }
    public function destroy($id)
    {
        $storeInfo = Extra::find($id);
        $logo = $storeInfo['logo'];
        if($logo){
            unlink($logo);
            $storeInfo->delete();
        }else{
            $storeInfo->delete();
        }
    }
}
