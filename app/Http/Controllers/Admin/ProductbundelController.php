<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\productbundel;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use App\Models\creditpoint;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductbundelController extends Controller
{

    public function index()
    {
        $products = Productbundel::with('images')->get();

        return view('admin.productbundel.list', compact('products'));
    }


    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $items = Product::where('status', 1)->get();

        return view('admin.productbundel.edit',compact('categories','items'));
    }

    public function edit($id){
        $productbundel = Productbundel::with('images')->find($id);
        $categories = Category::where('status', 1)->get();
        $items = Product::where('status', 1);
        if($productbundel->category_id)
            $items = $items->where('category_id', $productbundel->category_id);
        $items = $items->get();

        return view('admin.productbundel.edit', compact('productbundel','categories','items'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = $request->only('name','description','cost_price','selling_price','percentage_margin','discount_price','discount_start_date','discount_end_date','category_id','status','short_description');
        $item_ids = $request->item_ids;
        $item_ids = implode(",",$item_ids);
        $data['item_ids'] = $item_ids;
        try{
            $result = Productbundel::updateOrCreate(['id'=>$id] , $data);
            $image_ids = $request ->image_ids;
            if($image_ids != ""){
                $p_ids = explode(",",$image_ids);
                Attachment::where('attach_id', $result->id)->where('type','=','productbundel_image')->whereNotIn('id',$p_ids)->delete();
                foreach ($p_ids as $key => $value){
                    $name = "productbundel".$value;
                    $image_url = null;
                    if($request->hasFile($name)){
                        $image_url = $request->$name->store('productbundel_images','public');
                    }
                    if($image_url){
                        $attach_data = array();
                        $attach_data['attach_id'] = $result->id;
                        $attach_data['type'] = "productbundel_image";
                        $attach_data['url'] = asset('storage')."/".$image_url;
                        Attachment::create($attach_data);
                    }
                }
            }
        }catch (\Exception $e){
            session()->flash('product_bundel_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->route('admin.productbundel.list');
    }


    public function delete(Request $request){
        $id = $request->id;
        $attach = Attachment::where('attach_id', $id)->where('type','productbundel_image')->delete();
        $res = Productbundel::where('id', $id)->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }
    public function import(){
        return view('admin.productbundel.bundelimport');
    }
    public function import_excel(Request $request){
        try{
            $import = new ImportProduct();
            Excel::import($import, request()->file('upload'));

            return redirect()->route('admin.productbundel.list');
        }catch (\Exception $e){
            session()->flash('file_format_error',1);
            return redirect()->back();
        }
    }

    public function track($id){
        $product_bundle = productbundel::find($id);

        return view('admin.productbundel.track', compact('product_bundle'));
    }

    public function change(Request $request){
        $id=$request->category_id;

        $cat = Product::select('id AS pId', 'name AS pName')->where('category_id',$id)->get()->toArray();
        if(count($cat)>0) {
            echo json_encode($cat, true);
        }
    }
}
