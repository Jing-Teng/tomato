<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exam;
use App\Tomato;
use Charts;
use DB;

class ChartsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {

            $user_id = Auth::user()->id;
            $tomatoes = Tomato::where(['user_id' => $user_id] )->get();
           
            //預計專注時間(未完成+完成)
            $data = Tomato::select(DB::raw("SUM(length) as length"))
                    ->where(['user_id' => $user_id] )
                    ->groupBy(DB::raw("DATE_FORMAT(updated_at,'%m-%d')"))           
                    ->get();

            $data = Tomato::select(DB::raw("SUM(length) as length"))
                    ->where(['user_id' => $user_id] )
                    ->groupBy(DB::raw("DATE_FORMAT(updated_at,'%m-%d')"))           
                    ->get();

            $expected=array();
            for($i=0; $i<count($data); $i++){
                array_push($expected , $data[$i]['length'] );
            }
            //實際專注時間(完成)
            $data2 = Tomato::select(DB::raw("SUM(updated_at) as day"),DB::raw("SUM(length) as length"))
                    ->where(['user_id' => $user_id] )
                    ->where('result', '>', 0)
                    ->groupBy(DB::raw("day(updated_at)"))  
                    ->get();
            $real=array();
            for($i=0; $i<count($data2); $i++){
                array_push($real , $data2[$i]['length'] );
            }
            //日期 自己動手做QQ
            $data3 = Tomato::select("updated_at")
                    ->where(['user_id' => $user_id] )
                    ->get();
            $date=array();
            for($i=0; $i<count($data3); $i++){
                if( $i==0 )
                {
                    array_push( $date , $data3[$i]['updated_at'] ->format('Y-m-d') );
                }
                else if( $data3[$i-1]['updated_at']->format('Y-m-d') != $data3[$i]['updated_at']->format('Y-m-d'))
                {
                    array_push( $date , $data3[$i]['updated_at'] ->format('Y-m-d') );
                }
            }
     
            $chart = Charts::multi('bar', 'material')
                        ->title("我的累積專注時間")
                        ->template("material")
                        ->colors(['rgb(11, 57, 84)', 'rgb(224, 190, 54)'])
                        ->dataset('預計專注時間', $expected)
                        ->dataset('實際專注時間', $real)
                        ->labels( $date );

            return response()->json([
                'tomatoes' => $data
            ]);
        }      
        return view('welcome');
    }

    public function show($id)
    {
        $user_id = $id;
        $tomatoes = Tomato::where(['user_id' => $user_id] )->get();

        //預計專注時間(未完成+完成)
        $data = Tomato::select(DB::raw("SUM(length) as length"))
                ->where(['user_id' => $user_id] )
                ->groupBy(DB::raw("day(updated_at)"))  
                ->get();           
        $expected=array();
        for($i=0; $i<count($data); $i++){
            array_push($expected , $data[$i]['length'] );
        }
        //實際專注時間(完成)
        $data2 = Tomato::select(DB::raw("SUM(updated_at) as day"),DB::raw("SUM(length) as length"))
                ->where(['user_id' => $user_id] )
                ->where('result', '>', 0)
                ->groupBy(DB::raw("day(updated_at)"))  
                ->get();
        $real=array();
        for($i=0; $i<count($data2); $i++){
            array_push($real , $data2[$i]['length'] );
        }
        //日期
        $data3 = Tomato::select("updated_at")
                ->where(['user_id' => $user_id] )
                ->get();
        $date=array();
        for($i=0; $i<count($data3); $i++){
            if( $i==0 )
            {
                array_push( $date , $data3[$i]['updated_at'] ->format('Y-m-d') );
            }
            else if( $data3[$i-1]['updated_at']->format('Y-m-d') != $data3[$i]['updated_at']->format('Y-m-d'))
            {
                array_push( $date , $data3[$i]['updated_at'] ->format('Y-m-d') );
            }
        }
 
        $chart = Charts::multi('bar', 'material')
                    // Setup the chart settings
                    ->title("我的累積專注時間")
                    // A dimension of 0 means it will take 100% of the space
                    //->dimensions(0, 400) // Width x Height
                    // This defines a preset of colors already done:)
                    ->template("material")
                    // You could always set them manually
                    ->colors(['rgb(11, 57, 84)', 'rgb(224, 190, 54)'])
                    // Setup the diferent datasets (this is a multi chart)
                    ->dataset('預計專注時間', $expected)
                    ->dataset('實際專注時間', $real)
                    // Setup what the values mean
                    ->labels( $date );

        return view('charts',compact('chart'));
    }      


} 
