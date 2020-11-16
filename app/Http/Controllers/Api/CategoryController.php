<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required',
        ]);
        $data = $request->all();
        $category = new Category;
        $category->category_name        = $data['category_name'];
        $category->details              = $data['details'];
        $category->save();
    }
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required',
        ]);
        $category = array();
        $category['category_name'] = $request->category_name;
        $category['details'] = $request->details;
        Category::find($id)->update($category);
        
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
    }
}
