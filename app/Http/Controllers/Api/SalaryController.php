<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Salary;
use Illuminate\Http\Request;
use DB;
class SalaryController extends Controller
{
    public function paid(Request $request, $id){
        $validateData = $request->validate([
            'salary_month' => 'required',
        ]);
        $month = $request->salary_month;
        $check = Salary::where(['employee_id'=>$id,'salary_month'=>$month])->first();
        if($check){
            return response()->json("payment_already_exist");
        }else{
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            Salary::insert($data);
        }
    }
    public function allSession(){
        $session = Salary::select('salary_year')->groupBy('salary_year')->orderBy('salary_year','ASC')->get();
        return response()->json($session);
    }
    public function allSalary($id){
        $salary = Salary::select('salary_month')->where('salary_year',$id)->groupBy('salary_month')->orderBy('salary_date', 'ASC')->get();
        return response()->json($salary);
    }
    public function viewSalary($year,$month){
        $salary = Salary::with('employee')->where(['salary_month'=>$month,'salary_year'=>$year])->get();
        return response()->json($salary);
    }
    public function editSalary($id){
        // $salary = Salary::with('employee')->where('id',$id)->first();
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id','employees.id')
            ->select('employees.name','employees.email','salaries.*')
            ->where('salaries.id',$id)
            ->first();
        return response()->json($salary);
    }
    public function updateSalary(Request $request,$id){
            $data = array();
            $data['employee_id']    = $request->employee_id;
            $data['amount']         = $request->amount;
            $data['salary_month']   = $request->salary_month;
            Salary::find($id)->update($data);
    }
}
