<?php

//廢棄

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use Illuminate\Support\Facades\Auth;
use App\Exam;
use App\User;


class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * 取得user的所有exams
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user_id = Auth::user()->id; //取得關聯
        //$exam_id = $request->id; //取不到ㄟ
        $name = $request->input('name');
        $exam = Exam::where('name', $name)->get();
        return response()->json([
            'message' => 'sucess',
            'name' => $name,
            'exam' => $exam
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json([
            'message' => 'sucess',
            'exam' => $exam
        ]);
    }
} 
