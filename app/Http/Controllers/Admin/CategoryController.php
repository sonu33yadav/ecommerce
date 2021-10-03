<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    public function create(){

        return view('admin.category.edit');
    }


    public function edit($id){
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = $request->only('name','status');
        try{
            $result = Category::updateOrCreate(['id'=>$id], $data);
        }catch (\Exception $e){
            session()->flash('category_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->route('admin.category.list');
    }

    public function delete(Request $request){
        $id = $request->id;
        $res = Category::where('id', $id)->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }
}
