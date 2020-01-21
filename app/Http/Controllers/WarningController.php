<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
// 記得使用 use
use Illuminate\Support\Facades\Mail;
use App\Mail\Warning;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
 
class WarningController extends Controller
{
    use SendsPasswordResetEmails;

    public function send(Request $request)
    {
        $this->sendResetLinkEmail($request);

        return response()->json([
            'message' => 'success',
            'email' => $request->email ,
        ]);
    }

    public function send2(Request $request)
    {
        // 收件者務必使用 collect 指定二維陣列，每個項目務必包含 "name", "email"
        $to = collect([
            ['name' => 'user', 'email' => $request->email]
        ]);
    
        $url = 'http://34.85.51.56/password/reset';
        // 提供給模板的參數
        $params = [
            'say' => $url
        ];
    
        // 若要直接檢視模板
        // echo (new Warning($data))->render();die;
    
        Mail::to($to)->send(new Warning($params));

        
        return response()->json([
            'message' => 'success',
            'email' => $request->email,
        ]);
    }

}