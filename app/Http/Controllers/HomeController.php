<?php

namespace App\Http\Controllers;

use App\Models\RecommendAnswer;
use App\Models\RecommendQuestion;
use App\Models\ReferralTrack;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Question\Question;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = Setting::orderBy('id','ASC')->first();
        $recommend = 0;
        $questions = array();
        $answers = array();

        if($setting && $setting->use_recommendation == 1){
            $recommend = 1;
            $questions = RecommendQuestion::all();
            $answers = RecommendAnswer::all();
        }

        return view('home', compact('recommend','questions','answers'));
    }

    public function dashboard(){
        session()->flash('dashboard',1);
        if(Auth::guard()->check() === false){
            return redirect('/');
        }else{
            if(Auth::user()->hasVerifiedEmail() == false){
                return redirect('/email/verify');
            }
            if(Auth::user()->role == 'super_admin')
                return redirect()->route('manager.dashboard');
            else if(Auth::user()->role == 'admin')
                return redirect()->route('admin.dashboard');
            else if(Auth::user()->role == 'customer')
                return redirect()->route('home');
        }
    }

    public function follow($code){
        $customer = User::where('referral_code', $code)->first();
        $data = [
            'customer_id' => $customer->id,
            'tracker_id' => Auth::guard()->check()?Auth::id():0
        ];

        ReferralTrack::create($data);

        return redirect()->route('home');
    }
}
