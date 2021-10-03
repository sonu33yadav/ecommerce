<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportPromoCode;
use App\Models\Category;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PromoPrimaryType;
use App\Models\PromoSecondaryType;
use App\Models\Race;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PromoCodeController extends Controller
{
    public function index(){
        $codes = PromoCode::all();

        return view('admin.promoCode.list', compact('codes'));
    }

    public function create(){
        $pTypes = PromoPrimaryType::all();
        $sTypes = PromoSecondaryType::all();
        $products = Product::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $races = Race::all();

        return view('admin.promoCode.edit', compact('pTypes','sTypes','products','categories','races'));
    }

    public function edit($id){
        $promoCode = PromoCode::find($id);
        $pTypes = PromoPrimaryType::all();
        $sTypes = PromoSecondaryType::all();
        $products = Product::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $races = Race::all();

        return view('admin.promoCode.edit', compact('promoCode','pTypes','sTypes','products','categories','races'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = $request->only('code','limit','primary_type','secondary_type','start_date','end_date','desc','amount','earning_start_date','earning_end_date');
        $data['enable_member_limit'] = isset($request->enable_member_limit)?1:0;
        if($data['secondary_type']){
            $secondary = PromoSecondaryType::find($data['secondary_type']);
            switch ($secondary->type_name){
                case 'Product':
                    $data['secondary_info'] = $request->secondary_product;
                    break;
                case 'Product Category':
                    $data['secondary_info'] = $request->secondary_category;
                    break;
                case 'Customer Race':
                    $data['secondary_info'] = $request->secondary_race;
                    $data['earning_start_date'] = null;
                    $data['earning_end_date'] = null;
                    break;
                case 'Customer Gender':
                    $data['secondary_info'] = $request->secondary_gender;
                    $data['earning_start_date'] = null;
                    $data['earning_end_date'] = null;
                    break;
                case 'Customer Registration':
                    $data['secondary_info'] = $request->secondary_month;
                    $data['earning_start_date'] = null;
                    $data['earning_end_date'] = null;
                    break;
                case 'Customer Birthday':
                    $data['secondary_info'] = $request->secondary_month;
                    $data['earning_start_date'] = null;
                    $data['earning_end_date'] = null;
                    break;
                default:
                    $data['secondary_info'] = $request->secondary_info;
            }
            if($secondary->type_name != "Minimum Spend"){
                $data['secondary_info'] = implode(",", $data['secondary_info']);
            }
        }

        try{
            $result = PromoCode::updateOrCreate(['id'=>$id], $data);
        }catch (\Exception $e){
            session()->flash('promoCode_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->route('admin.promoCode.list');
    }

    public function delete(Request $request){
        $id = $request->id;
        $res = PromoCode::where('id', $id)->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }

    public function import(){
        return view('admin.promoCode.import');
    }

    public function import_excel(Request $request){
        try{
            $import = new ImportPromoCode();
            Excel::import($import, request()->file('upload'));

            return redirect()->route('admin.promoCode.list');
        }catch (\Exception $e){
            session()->flash('file_format_error',1);
            return redirect()->back();
        }
    }

    public function track($id){
        $promoCode = PromoCode::find($id);

        return view('admin.promoCode.track', compact('promoCode'));
    }
}
