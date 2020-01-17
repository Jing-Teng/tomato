<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ExamRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exam;


class ExamController extends Controller
{
    // 改到 Route
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id; // 取得目前的已認證使用者
        //$user_id = auth()->user()->id;        
        $user = User::find($user_id); //以 user_id 搜尋 user
        $exams = Exam::where('user_id', $request->user()->id)->get();
        return response()->json([
            'message' => 'sucess',
            //'user' => $user,
            'exams' => $exams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        // 改用 ExamRequest
        // $this->validate($request, [ 
        //     'name' => 'required|max:255',
        // ]);

        $exam = new Exam($request->all());
        $exam->user_id = Auth::user()->id;
        $exam->save();
        return response()->json([
            'message' => 'sucess',
            'exam' => $exam
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user_id = Auth::user()->id; //取得關聯
        
        //$exam = Exam::where('id', $id)->get(); 回傳 collection 會掛掉
        $exam = Exam::where('id', $id)->first();
        if(Auth::id() == $exam->user_id){
            return response()->json([
                'message' => 'sucess',
                'exam' => $exam
            ]);
        }
        else{
            return response()->json([
                'message' => 'permission denied'
            ],403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::where('id', $id)->first();
        if(Auth::id() == $exam->user_id){
            $exam->update($request->all());           
            return response()->json([
                'message' => 'sucess',
                'exam' => $exam
            ]);
        }
        else{
            return response()->json([
                'message' => 'permission denied'
            ],403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //刪掉 exam 底下的關聯應該也要被刪掉
        $exam = Exam::where('id', $id)->first();
        if(Auth::id() == $exam->user_id){
            
            $exam->delete();
            return response()->json([
                'message' => 'sucess',
                'exam' => $exam
            ]);
        }
        else{
            return response()->json([
                'message' => 'permission denied'
            ],403);
        }

    }
}
