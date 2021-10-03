<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Race;
use App\Models\creditpoint;
use App\Models\PromoCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($type){
        $user = User::with('race','country')->find(Auth::id());
        $races = Race::all();
        $points = creditpoint::all();
        
        $countries = Country::orderBy('name','ASC')->get();

        $myCarts = \App\Models\Cart::where('customer_id', \Illuminate\Support\Facades\Auth::id())->pluck('product_id')->toArray();
        $cartProducts = \App\Models\Product::whereIn('id', $myCarts)->get();
        //  print_r($cartProducts);die;

        return view('customer.main', compact('type', 'user', 'races', 'countries','myCarts','cartProducts','points'));
    }
    public function cupon(Request $request){ 
        $coupon=$request->coupon_code;
         $cp_code = PromoCode::select('amount')->where('code',$coupon)->get()->toarray();
        if(count($cp_code)>0) {
            echo json_encode(array(
				      "statusCode"=>200,
				      "value"=>$cp_code[0]
			));
     }else{
	       echo json_encode(array("statusCode"=>201));
           }
        }
        
    }
