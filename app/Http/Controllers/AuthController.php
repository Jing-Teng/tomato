<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
//use Validator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;// json response

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
    // public function signup(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string|email|unique:users',
    //         'password' => 'required|string|confirmed'
    //     ]);
    //     $user = new User([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);
    //     $user->save();
    //     return response()->json([
    //         'message' => 'Successfully created user!'
    //     ], 201);
    // }

    public function register(Request $request): JsonResponse
    {
	$this->validate($request, [
	    'name' => ['required', 'string', 'max:255'],
	    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	    'password' => ['required', 'string', 'min:8'],
	]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            //'password' => Hash::make($request->get('password')),
	        'password' => bcrypt($request->password)
	]);

	//$response = response()->json($validator);
	//$response = response()->json($validated);
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
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
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
}