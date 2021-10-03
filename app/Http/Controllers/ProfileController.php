<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();

        if($user->role == 'customer')
            return view('customer.profile', compact('user'));
        else
            return view('admin.edit_profile', compact('user'));
    }

    public function edit(){
        $user = Auth::user();

        if($user->role == 'customer')
            return view('customer.edit_profile', compact('user'));
        else
            return view('admin.edit_profile', compact('user'));
    }

    public function update(Request $request){
        $id = Auth::id();
        $user = Auth::user();
        $data = $request->only('name','contact_number','address','language',
            'birthday','gender','race_id','address2','address3','postcode','state','country_id');
        $avatar = null;
        if($request->hasFile('avatar')){
            $avatar = $request->avatar->store('avatars','public');
        }
        if($avatar){
            $data['avatar'] = asset('storage')."/".$avatar;
        }

        try{
            if(isset($request->reset)){
                if(Hash::check($request->old_password, $user->password)){
                    $data['password'] = Hash::make($request->new_password);
                }else{
                    session()->flash('old_pass_incorrect', 1);
                    return redirect()->back();
                }
            }
            $result = User::where('id', $id)->update($data);
        }catch (\Exception $e){
            session()->flash('user_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->to('/main/account');
    }

    public function update_admin(Request $request){
        $id = Auth::id();
        $user = Auth::user();
        $data = $request->only('name','contact_number','department','designation');

        try{
            if(isset($request->reset)){
                if(Hash::check($request->old_password, $user->password)){
                    $data['password'] = Hash::make($request->new_password);
                }else{
                    session()->flash('old_pass_incorrect', 1);
                    return redirect()->back();
                }
            }
            $result = User::where('id', $id)->update($data);
            session()->flash('update_success', 1);
        }catch (\Exception $e){
            session()->flash('user_edit_error', 1);
            return redirect()->back();
        }

        return redirect()->back();
    }
}
