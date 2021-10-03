<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CustomerAnswer;
use App\Models\Product;
use App\Models\RecommendPair;
use App\Models\RecommendQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($id){
        if ($id == 0){
            $data = Product::with('images')->where('status',1)->orderBy('created_at', 'DESC')->paginate(10);
            $count = count($data);
            $pagination_params = [
                'result' => $count,
                'per_page' => 10
            ];

            return view('product_all', compact('pagination_params'), ['data'=>$data]);
        }else{
            $product = Product::find($id);

            return view('product',compact('product'));
        }
    }

    public function addToCart($product_id){
        $customer_id = Auth::id();

        $data = [
            'customer_id' => $customer_id,
            'product_id' => $product_id
        ];

        Cart::where('customer_id', $customer_id)->where('product_id', $product_id)->updateOrCreate($data);

        return redirect()->to('main/cart');
    }

    public function answer(Request $request){
        $questions = RecommendQuestion::all();
        $answers = array();
        foreach ($questions as $question){
            $id = $question->id;
            $name = "answer_".$id;
            $val = $request->$name;
            if($val)
                $answers[] = $val;
        }
        $answer_string = implode(",", $answers);
        $recommend = RecommendPair::where('answer_ids', $answer_string)->first();
        if($recommend){
            if (Auth::check()){
                $answer_data = [
                    'customer_id' => Auth::id(),
                    'recommmend_answer_id' => $recommend->id
                ];
                CustomerAnswer::where('customer_id', Auth::id())->updateOrCreate($answer_data);
            }
            $product_ids = $recommend->product_ids;
            $ids = explode(",",$product_ids);

            $data = Product::with('images')->whereIn('id', $ids)->where('status',1)->orderBy('created_at', 'DESC')->paginate(10);
            $count = count($data);
            $pagination_params = [
                'result' => $count,
                'per_page' => 10
            ];
        }else{
            $pagination_params = [];
            $data = [];
        }

        return view('product_all', compact('pagination_params'), ['data' => $data, 'recommend' => 1]);
    }

    public function removeCart(Request $request){
        $id = $request->id; //this is product id in cart table

        Cart::where('product_id', $id)->where('customer_id', Auth::id())->delete();

        return response()->json(['status'=>true,'result'=>true]);
    }
}
