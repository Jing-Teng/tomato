<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id; // 取得目前的已認證使用者     
        $user = User::find($user_id); //以 user_id 搜尋 user
        $tasks = Task::where('user_id', $request->user()->id)->get();
        return response()->json([
            'message' => 'success',
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task($request->all());
        $task->user_id = Auth::user()->id;
        $task->save();
        return response()->json([
            'message' => 'success',
            //'id' => $task->user_id,
            'task' => $task
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
        $task = Task::where('id', $id)->get();
        return response()->json([
            'message' => 'success',
            //'name' => $name,
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $task = Task::where('id', $id)->first();
        $task->update($request->all());
        return response()->json([
            'message' => 'success',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->first(); //get 改成 first
        $task->delete();
        return response()->json([
            'message' => 'success',
            'task' => $task
        ]);
    }
}
