<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exam;
use App\Tomato;

class TomatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $examId)
    {
        $user_id = Auth::user()->id; // 取得目前的已認證使用者     
        //$user = User::find($user_id); //以 user_id 搜尋 user
        //$exam = Exam::where('user_id', $request->user()->id)->get();
        $tomatoes = Tomato::where(['exam_id' => $examId, 'user_id' => $user_id] )->get();
 
        return response()->json([
            'message' => 'success',          
            'tomatoes' => $tomatoes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $examId)
    {

        $tomato = new Tomato($request->all());
        $tomato->exam_id = $examId;
        $tomato->user_id = Auth::id();
        $tomato->save();
        return response()->json([
            'message' => 'success',
            'tomato' => $tomato
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($examId, $tomatoId)
    {
        //$exam = Exam::where('id', $examId)->first();
        $tomato = Tomato::where('id', $tomatoId)->first();
        if(Auth::id() == $tomato->user_id){
            
            return response()->json([
                'message' => 'success',
                'tomato' => $tomato
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
    public function update(Request $request, $examId, $tomatoId)
    {
        //$exam = Exam::where('id', $examId)->first();
        $tomato = Tomato::where('id', $tomatoId)->first();
        if(Auth::id() == $tomato->user_id){
           
            $tomato->update($request->all());
            return response()->json([
                'message' => 'success',
                'tomato' => $tomato
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
    public function destroy($examId, $tomatoId)
    {
        $tomato = Tomato::where('id', $tomatoId)->first();
        if(Auth::id() == $tomato->user_id){
           
            $tomato->delete();
            return response()->json([
                'message' => 'success',
                'tomato' => $tomato
            ]);
        }
        else{
            return response()->json([
                'message' => 'permission denied'
            ],403);
        }
    }

    public function findTomatosByDate($examId,Request $request)
    {
        $created_at = $request->created_at;
        $startTime = $created_at . " 00:00:00";
        $endTime = $created_at . " 23:59:59";
        $user_id = Auth::user()->id; // 取得目前的已認證使用者     
        $user = User::find($user_id); //以 user_id 搜尋 user
        $exam = Exam::where('user_id', $request->user()->id)->get();
        $tomatoes = Tomato::where('exam_id' , $examId)
                    ->whereBetween('created_at', array($startTime , $endTime))
                    ->get();
        
        return response()->json([
            'message' => 'success',
            'tomatoes' => $tomatoes
        ]);
    }

    public function findTomatosBetweenDates($examId,Request $request)
    {
        $start_date = $request->start_date . " 00:00:00";
        $end_date = $request->$end_date . " 23:59:59";
        $user_id = Auth::user()->id; // 取得目前的已認證使用者     
        $user = User::find($user_id); //以 user_id 搜尋 user
        $exam = Exam::where('user_id', $request->user()->id)->get();
        $tomatoes = Tomato::where('exam_id' , $examId)
                    ->whereBetween('created_at', array($start_date , $end_date))
                    ->get();
        
        return response()->json([
            'message' => 'success',
            'tomatoes' => $tomatoes
        ]);
    }
}
