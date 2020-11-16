<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'email'=>'required | unique:employees',
            'phone'=>'required ',
            'nid'=>'required ', 
        ]);
        $data = $request->all();
        $employee = new Employee;
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
            $image_url = 'backend/image/employee/'.$image_name;
            // file_put_contents($image_url,$decoded);
            Image::make($decoded)->resize(300, 300)->save($image_url);
            $employee->name         = $data['name'];
            $employee->email        = $data['email'];
            $employee->phone        = $data['phone'];
            $employee->salary       = $data['salary'];
            $employee->address      = $data['address'];
            $employee->nid          = $data['nid'];
            $employee->joining_date = $data['joining_date'];
            $employee->gender       = $data['gender'];    
            $employee->photo        = $image_url;
            $employee->save();
        }else{
            $employee->name         =$data['name'];
            $employee->email        =$data['email'];
            $employee->phone        =$data['phone'];
            $employee->salary       =$data['salary'];
            $employee->address      =$data['address'];
            $employee->nid          =$data['nid'];
            $employee->joining_date =$data['joining_date'];
            $employee->gender       =$data['gender'];    
            $employee->save();
        }
    }
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'phone'=>'required ',
            'nid'=>'required ',  
        ]);
        $employee = array();
        $employee['name'] = $request->name;
        $employee['email'] = $request->email;
        $employee['phone'] = $request->phone;
        $employee['salary'] = $request->salary;
        $employee['address'] = $request->address;
        $employee['nid'] = $request->nid;
        $employee['joining_date'] = $request->joining_date;
        $employee['gender'] = $request->gender;
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
            $image_name = rand(99,99999).'-employee'.'.'.$ext;
            $image_url = 'backend/image/employee/'.$image_name;
            $success = Image::make($decoded)->resize(300,300)->save($image_url);
            if($success){
                $employee['photo'] = $image_url;
                $employee_info = Employee::find($id);
                if(!empty($employee_info->photo)){
                    unlink($employee_info->photo);
                }else{

                }
                $employee_info->update($employee);
            }
        }
        else
        {
            $old_photo = $request->photo;
            $employee['photo'] = $old_photo;
            Employee::find($id)->update($employee);
        }


    }
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $photo = $employee['photo'];
        if($photo){
            unlink($photo);
            $employee->delete();
        }else{
            $employee->delete();
        }
       
    }
}
