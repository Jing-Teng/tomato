<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;// json response
use DB;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request): JsonResponse
    {

        $this->validate($request, [
            'email' => ['unique:users']
        ]);


        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password)
        ]);
        $response = response()->json(
        [
            'message' => 'success',
        ]);
        return $response;
    }


  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
		
            'message' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
	        'user' => $user	
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'success'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function builder(Request $request)
    {

        $user_id = Auth::user()->id;

        $id = DB::table('tomatoes')->insertGetId(
            [ 
                "name" => "新增的任務會顯示在這", 
                "result" => "0", 
                "position" => "0",
                "length" => "25",
                "minute" => "25",
                "pcs" => "1",
                "icon" => "icon_brainstorm",
                "color" => "activity_1",
                "exam_id" => "1",
                "user_id" => $user_id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );

        $id = DB::table('tomatoes')->insertGetId(
            [ 
                "name" => "點擊後開始", 
                "result" => "0", 
                "position" => "1",
                "length" => "25",
                "minute" => "25",
                "pcs" => "1",
                "icon" => "icon_school",
                "color" => "activity_2",
                "exam_id" => "1",
                "user_id" => $user_id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );

        $id = DB::table('tomatoes')->insertGetId(
            [ 
                "name" => "按右邊的鉛筆可以重新編輯", 
                "result" => "0", 
                "position" => "2",
                "length" => "25",
                "minute" => "25",
                "pcs" => "1",
                "icon" => "icon_exercise",
                "color" => "activity_3",
                "exam_id" => "1",
                "user_id" => $user_id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );

        $id = DB::table('tomatoes')->insertGetId(
            [ 
                "name" => "往左滑刪除", 
                "result" => "0", 
                "position" => "3",
                "length" => "25",
                "minute" => "25",
                "pcs" => "1",
                "icon" => "icon_science",
                "color" => "activity_5",
                "exam_id" => "1",
                "user_id" => $user_id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );

        $id = DB::table('tomatoes')->insertGetId(
            [ 
                "name" => "做完的任務會移至此", 
                "result" => "1", 
                "position" => "0",
                "length" => "25",
                "minute" => "25",
                "pcs" => "1",
                "icon" => "icon_discussion",
                "color" => "activity_4",
                "exam_id" => "1",
                "user_id" => $user_id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );

        return response()->json([
            'message' => 'success'
        ]);

    }
    
}