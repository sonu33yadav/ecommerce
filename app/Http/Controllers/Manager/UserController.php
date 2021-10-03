<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Race;
use App\Models\ReferralTrack;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','!=','customer')->get();

        return view('manager.user.list', compact('users'));
    }

    public function create(){

        return view('manager.user.edit');
    }


    public function edit($id){
        $user = User::find($id);

        return view('manager.user.edit', compact('user'));
    }

    public function update(Request $request){
        $id = $request->id;

        //check if this customer is a super admin
        if($id > 0){
            $pUser = User::find($id);
            if($pUser->role == "super_admin" && Auth::user()->role != "super_admin"){
                session()->flash('no_permission', 1);
                return redirect()->back();
            }
        }

        $data = $request->only('name','email','contact_number','address','department','designation','role','status','manage_status','language',
                                'birthday','gender','race_id','address2','address3','postcode','state','country_id');
        $avatar = null;
        if($request->hasFile('avatar')){
            $avatar = $request->avatar->store('avatars','public');
        }
        if($avatar){
            $data['avatar'] = asset('storage')."/".$avatar;
        }
        if($id == 0){
            $data['password'] = Hash::make($request->password);
            $data['referral_code'] = generateRandomString();
            $data['member_id'] = "NMS".generateRandomNumber();
        }
        try{
            if(isset($request->reset)){
                $data['password'] = Hash::make($request->password);
            }
            $result = User::updateOrCreate(['id'=>$id], $data);

            //send verification email
            if($id == 0){
                $sent = $result->sendEmailVerificationNotification();
            }
        }catch (\Exception $e){
            session()->flash('user_edit_error', 1);
            return redirect()->back();
        }

        if(isset($request->edit_customer))
            return redirect()->route('admin.customer.list');
        else
            return redirect()->route('manager.user.list');
    }

    public function delete(Request $request){
        $id = $request->id;
        $res = User::where('id', $id)->delete();

        return response()->json(['status'=>true, 'result'=>true]);
    }

    public function customer_index(){
        $users = User::all();

        return view('manager.customer.list', compact('users'));
    }

    public function customer_edit($id){
        $user = User::find($id);
        $races = Race::all();
        $countries = Country::orderBy('name','ASC')->get();

        return view('manager.customer.edit', compact('user', 'races', 'countries'));
    }

    public function referral_edit($id){
        $user = User::with('referral_track')->find($id);

        return view('manager.customer.referral', compact('user'));
    }

    public function credit_edit($id){
        $user = User::find($id);

        return view('manager.customer.edit_credit', compact('user'));
    }
}
