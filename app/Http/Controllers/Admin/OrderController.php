<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('admin.order.list');
    }

    public function getOrders(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $filter_type = $request->filter_type;
        $filter_text = $request->filter_text;
        $orders = Order::with('user','product')->where('order_date', '>=',$start_date)->where('order_date','<=',$end_date);
        if ($filter_text){
            if ($filter_type == "customer_name")
                $orders = $orders->whereHas('user',function ($query) use ($filter_text){
                    $query->where('name','like', '%' . $filter_text . '%');
                });
            else if($filter_type == "customer_id")
                $orders = $orders->whereHas('user',function ($query) use ($filter_text){
                    $query->where('id','like', '%' . $filter_text . '%');
                });
            else if($filter_type == "customer_contact")
                $orders = $orders->whereHas('user',function ($query) use ($filter_text){
                    $query->where('contact_number','like', '%' . $filter_text . '%');
                });
            else if($filter_type == "customer_email")
                $orders = $orders->whereHas('user',function ($query) use ($filter_text){
                    $query->where('email','like', '%' . $filter_text . '%');
                });
            else if($filter_type == "order_number")
                $orders = $orders->where('order_number', 'like','%' . $filter_text . '%');
            else if($filter_type == "order_date")
                $orders = $orders->where('order_date', 'like','%' . $filter_text . '%');
            else if($filter_type == "referral_code")
                $orders = $orders->where('referral_code', 'like','%' . $filter_text . '%');
            else if($filter_type == "product")
                $orders = $orders->whereHas('product',function ($query) use ($filter_text){
                    $query->where('name','like', '%' . $filter_text . '%');
                });
        }
        $orders = $orders->get();

        return response()->json($orders);
    }
}
