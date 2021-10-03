<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\creditpoint;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CreditpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = creditpoint::all();

        return view('admin.creditpoint.list', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.creditpoint.edit');
    }


    public function edit($id){
        $creditpoint = creditpoint::find($id);

        return view('admin.creditpoint.edit', compact('creditpoint'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = $request->only('point_end_date','point_earn','point_type','second_level');
        try{
            $result = creditpoint::updateOrCreate(['id'=>$id], $data);
        }catch (\Exception $e){
            session()->flash('credit_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->route('admin.creditpoint.list');
    }

    public function delete(Request $request){
        $id = $request->id;
        $res = creditpoint::where('id', $id)->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }


    public function import(){
        return view('admin.creditpoint.import');
    }
}
