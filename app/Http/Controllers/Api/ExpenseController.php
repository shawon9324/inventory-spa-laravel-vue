<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;
class ExpenseController extends Controller
{
    public function index()
    {
        $expense = Expense::all();
        return response()->json($expense);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);
        $data = $request->all();
        $expense = new Expense;
        $expense->details        = $data['details'];
        $expense->amount         = $data['amount'];
        $expense->expense_date   = $data['expense_date'];
        $expense->save();
    }
    public function show($id)
    {
        $expense = Expense::find($id);
        return response()->json($expense);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);
        $expense = array();
        $expense['details'] = $request->details;
        $expense['amount'] = $request->amount;
        $expense['expense_date'] = $request->expense_date;
        Expense::find($id)->update($expense);
        
    }
    public function destroy($id)
    {
        Expense::find($id)->delete();
    }
}
