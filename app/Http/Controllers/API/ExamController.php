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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exams = Exam::where('user_id', $request->user()->id)->get();
        return response()->json([
            'message' => 'success',
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
        $exam = new Exam($request->all());
        $exam->user_id = Auth::user()->id;
        $exam->save();
        return response()->json([
            'message' => 'success',
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
        $exam = Exam::where('id', $id)->first();
        if(Auth::id() == $exam->user_id){
            return response()->json([
                'message' => 'success',
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
                'message' => 'success',
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
        $exam = Exam::where('id', $id)->first();
        if(Auth::id() == $exam->user_id){
            
            $exam->delete();
            return response()->json([
                'message' => 'success',
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
