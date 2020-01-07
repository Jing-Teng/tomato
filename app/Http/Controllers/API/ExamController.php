<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use Illuminate\Support\Facades\Auth;
use App\Exam;
use App\User;


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
        //$exam_id = $request->id; //取不到ㄟ
        
        $exam = Exam::where('id', $id)->get();
        return response()->json([
            'message' => 'sucess',
            //'name' => $name,
            'exam' => $exam
        ]);
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
        
        // $newExam = new Exam($request->all());
        // $exam = Exam::where('id', $id)->get();
        // return response()->json([
        //     'message' => 'sucess',
        //     //'name' => $name,
        //     'exam' => $exam
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::where('id', $id)->get();
        $exam->delete();
        return response()->json([
            'message' => 'sucess',
            'exam' => $exam
        ]);
    }
}
