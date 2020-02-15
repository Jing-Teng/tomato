<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\User;


// 讓使用者儲存 setting 
class SettingController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $setting = Setting::where('user_id', $request->user()->id)->get();
        }
        return response()->json([
            'message' => 'success',
            'setting' => $setting 
        ]);
    }

    public function store(Request $request)
    {
        $setting = new Setting($request->all());
        $setting->user_id = Auth::user()->id;
        $setting->save();
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function update($id,Request $request)
    {
        $setting = Setting::where('id', $id)->first();
        $setting->update($request->all());
        return response()->json([
            'message' => 'success',
            'setting' => $setting
        ]);
    }

}
