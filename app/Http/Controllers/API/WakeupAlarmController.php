<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exam;
use App\WakeupAlarm;

class WakeupAlarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $examId)
    {
        $user_id = Auth::user()->id; // 取得目前的已認證使用者     
        $user = User::find($user_id); //以 user_id 搜尋 user
        $exam = Exam::where('user_id', $request->user()->id)->get();
        $wakeup_alarms = WakeupAlarm::where('exam_id', $examId)->get();
        
        return response()->json([
            'message' => 'success',          
            'wakeup_alarms' => $wakeup_alarms
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
        $wakeup_alarm = new WakeupAlarm($request->all());
        $wakeup_alarm->exam_id = $examId;
        $wakeup_alarm->save();
        return response()->json([
            'message' => 'success',
            'wakeup_alarm' => $wakeup_alarm
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($examId, $wakeupAlarmId)
    {
        //$exam = Exam::where('id', $examId)->first();
        $wakeup_alarm = WakeupAlarm::where('id', $wakeupAlarmId)->first();
        return response()->json([
            'message' => 'success',
            'wakeup_alarm' => $wakeup_alarm
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $examId, $wakeupAlarmId)
    {
        //$exam = Exam::where('id', $examId)->first();
        $wakeup_alarm = WakeupAlarm::where('id', $wakeupAlarmId)->first();
        $wakeup_alarm->update($request->all());
        return response()->json([
            'message' => 'success',
            'wakeup_alarm' => $wakeup_alarm
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($examId, $wakeupAlarmId)
    {
        $wakeup_alarm = WakeupAlarm::where('id', $wakeupAlarmId)->first(); 
        $wakeup_alarm->delete();
        return response()->json([
            'message' => 'success',
            'wakeup_alarm' => $wakeup_alarm
        ]);
    }
}
