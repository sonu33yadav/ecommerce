<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportProduct;
use App\Imports\ImportProductSheet;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\RecommendAnswer;
use App\Models\RecommendPair;
use App\Models\RecommendQuestion;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Question\Question;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('images')->get();

        return view('admin.product.list', compact('products'));
    }

    public function create(){
        $categories = Category::where('status', 1)->get();

        return view('admin.product.edit',compact('categories'));
    }


    public function edit($id){
        $product = Product::with('images','packages')->find($id);
        $categories = Category::where('status', 1)->get();
        $packages = ProductPackage::where('product_id', $id)->get()->toArray();

        return view('admin.product.edit', compact('product','categories', 'packages'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = $request->only('name','description','cost_price','selling_price','percentage_margin','discount_price','discount_start_date','discount_end_date','stock_quantity','status','category_id','short_description');
        try{
            if($data['short_description'] == null)
                $data['short_description'] = '';
            $result = Product::updateOrCreate(['id'=>$id], $data);

            //add packages
            $product_id = $result->id;
            ProductPackage::where('product_id', $product_id)->delete();
            $package_names = $request->package_name;
            $package_quantities = $request->package_quantity;
            $package_prices = $request->package_price;
            if($package_names){
                foreach ($package_names as $key => $name){
                    $data = [
                        'product_id' => $product_id,
                        'name' => $name,
                        'quantity' => $package_quantities[$key],
                        'price' => $package_prices[$key]
                    ];

                    ProductPackage::create($data);
                }
            }

            //add product images
            $image_ids = $request ->image_ids;
            if($image_ids != ""){
                $p_ids = explode(",",$image_ids);
                Attachment::where('attach_id', $product_id)->where('type','=','product_image')->whereNotIn('id',$p_ids)->delete();
                foreach ($p_ids as $key => $value){
                    $name = "product".$value;
                    $image_url = null;
                    if($request->hasFile($name)){
                        $image_url = $request->$name->store('product_images','public');
                    }
                    if($image_url){
                        $attach_data = array();
                        $attach_data['attach_id'] = $product_id;
                        $attach_data['type'] = "product_image";
                        $attach_data['url'] = asset('storage')."/".$image_url;
                        Attachment::create($attach_data);
                    }
                }
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            session()->flash('product_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->route('admin.product.list');
    }

    public function delete(Request $request){
        $id = $request->id;

        $attach = Attachment::where('attach_id', $id)->where('type','product_image')->delete();
        $res = Product::where('id', $id)->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }

    public function view_testimonials($id){
        $product = Product::find($id);
        $testimonials = Testimonial::with('user','attach')->where('product_id', $id)->get();

        return view('admin.product.testimonial_list', compact('product','testimonials'));
    }

    public function create_testimonial($product_id){
        $products = Product::all();
        $users = User::where('role','!=','super_admin')->get();
        return view('admin.product.testimonial_edit', compact('product_id', 'products', 'users'));
    }

    public function edit_testimonial($testimonial_id){
        $testimonial = Testimonial::with('user','attach')->where('id', $testimonial_id)->first();
        $products = Product::all();
        $users = User::where('role','!=','super_admin')->get();

        return view('admin.product.testimonial_edit', compact('testimonial','products','users'));
    }

    public function update_testimonial(Request $request){
        $testimonial_id = $request->id;
        $data = $request->only('product_id','user_id','type','desc');
        try{
            $result = Testimonial::updateOrCreate(['id'=>$testimonial_id], $data);
            $media = null;
            if($request->hasFile('media')){
                $media = $request->media->store('testimonials','public');
            }
            if($media){
                $url = asset('storage')."/".$media;
                if($testimonial_id == 0)
                {
                    $attachment = [];
                    $attachment['attach_id'] = $result->id;
                    $attachment['type'] = 'testimonial';
                    $attachment['url'] = $url;
                    Attachment::create($attachment);
                }else{
                    Attachment::where('type','testimonial')->where('attach_id', $testimonial_id)->update(['url'=>$url]);
                }

                return redirect()->route('admin.product.testimonial.view', $data['product_id']);
            }
        }catch (\Exception $e){
            session()->flash('testimonial_edit_error', 1);
            return redirect()->back();
        }
    }

    public function recommend(){
        $setting = Setting::orderBy('id','ASC')->first();
        $products = Product::where('status', 1)->get();

        return view('admin.product.recommend', compact('setting', 'products'));
    }

    public function save_recommend(Request $request){
        $questions = $request->questions;
        $answers = $request->answers;
        $products = $request->products;
        $answerSeries = $request->answer_series;

        RecommendQuestion::truncate();
        RecommendAnswer::truncate();
        RecommendPair::truncate();
        $answerIds = array();
        $answerIndex = 0;

        foreach ($questions as $question){
            $new_question = RecommendQuestion::create(['question'=>$question['value']]);
            $ans = $answers[$question['id']];
            $answerIds[$answerIndex] = [];
            foreach ($ans as $one){
                $new_answer = RecommendAnswer::create(['question_id'=>$new_question->id, 'answer'=>$one['value']]);
                $answerIds[$answerIndex][] = $new_answer->id;
            }
            $answerIndex++;
        }

        //make answer pair
        $newSeries = array();
        foreach ($answerSeries as $one){
            $val = $one['value'];
            $arr = explode("-", $val);
            $new = array();
            for($i=0; $i<count($arr); $i++){
                $index = $arr[$i] - 1;
                $new[] = $answerIds[$i][$index];
            }
            $newSeries[] = implode(",", $new);
        }

        $id = 0;
        foreach ($newSeries as $one){
            $product_ids = implode(",", $products[$id]);
            RecommendPair::create(['answer_ids'=>$one, 'product_ids'=>$product_ids]);
            $id++;
        }

        return response()->json(['status'=>true, 'result'=>true]);
    }

    public function get_recommend(){
        $questions = RecommendQuestion::all();
        $answers = RecommendAnswer::all();
        $pairs = RecommendPair::all();

        return response()->json(['status'=>true, 'questions'=>$questions, 'answers'=>$answers, 'pairs'=>$pairs]);
    }

    public function import(){
        return view('admin.product.import');
    }

    public function import_excel(Request $request){
        try{
            $import = new ImportProduct();
            Excel::import($import, request()->file('upload'));

            return redirect()->route('admin.product.list');
        }catch (\Exception $e){
            session()->flash('file_format_error',1);
            return redirect()->back();
        }
    }
}
