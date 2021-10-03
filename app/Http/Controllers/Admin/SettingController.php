<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function change(Request $request){
        $use_recommendation = $request->use_recommend;

        $setting = Setting::orderBy('id','ASC')->first();
        if($use_recommendation == 1)
        {
            $setting->use_recommendation = 1;
        }else{
            $setting->use_recommendation = 0;
        }
        $setting->save();

        return response()->json(['result'=>true]);
    }

    public function getSetting(Request $request){
        $setting = Setting::orderBy('id','ASC')->first();

        return response()->json(['setting'=>$setting]);
    }
}
