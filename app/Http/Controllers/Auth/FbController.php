<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FbController extends Controller
{
    public function redirectToFacebook($type)
    {
        session()->put('facebook', $type);
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookAuth()
    {
        $type = session()->get('facebook');
        try {
            $user = Socialite::driver('facebook')->user();

            if($type == "register"){
                $existUser = User::where('email', $user->email)->first();

                if($existUser){
                    session()->flash('facebook_auth', 'email_in_use');
                }else{
                    $createUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->id,
                        'login_type' => 'facebook',
                        'email_verified_at' => date('Y-m-d H:i:s'),
                        'password' => Hash::make('Niimisi'),
                        'referral_code' => generateRandomString(),
                        'member_id' => "NMS".generateRandomNumber()
                    ]);

                    Auth::login($createUser);
                    session()->flash('facebook_auth', 'register_success');
                }
                return redirect()->route('home');
            }else{
                $existUser = User::where('facebook_id', $user->id)->first();
                if($existUser){
                    Auth::login($existUser);
                    return redirect()->route('dashboard');
                }else{
                    session()->flash('facebook_auth', 'not_registered_user');
                    return redirect()->route('home');
                }
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
