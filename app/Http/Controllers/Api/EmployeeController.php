<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'gender'=> 'required ',
            'email'=>'required | unique:employees',
            'phone'=>'required ',
            'nid'=>'required ',   
        ]);
        if($request->hasFile('photo')){
            $data = $request->all();
            $position = strpos($request->photo,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];
            $image_name = rand(99,99999).".".$ext;
            $img = Image::make($request->photo)->resize(300,300); 
            $upload_path = 'backend/image/employee/';
            $img_url = $upload_path.$image_name;                //TODO:Image Uploaded But Not Stored in the DB
            $img->save($img_url);
            $employee = new Employee;

            $employee->name         =$data['name'];
            $employee->email        =$data['email'];
            $employee->phone        =$data['phone'];
            $employee->salary       =$data['salary'];
            $employee->address      =$data['address'];
            $employee->nid          =$data['nid'];
            $employee->joining_date =$data['joining_date'];
            $employee->gender       =$data['gender'];    
            $employee->photo        =$img_url;
            $employee->save();
        }else{
            $data = $request->all();

            $employee = new Employee;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
