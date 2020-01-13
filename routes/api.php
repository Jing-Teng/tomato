<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth::guard('api')->user();

Route::group([
    'prefix' => 'auth'
    ], function () {
    Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

//Route::resource('Exam','ExamController');
//Route::resource('Task','TaskController');

// Route::group([
//     'prefix' => 'exam'
//     ], function () {
//     Route::get('/', 'ExamController@index')->name('api.exam.get_all');
//     Route::post('/', 'ExamController@store')->name('api.exam.post');
//     Route::delete('/{exam}', 'ExamController@destroy')->name('api.exam.delete');

//     Route::group([
//       'middleware' => 'auth:api'
//     ], function() {

//     });
// });

// Route::get('/exams', 'ExamController@index')->name('api.exam.get_all');
// Route::post('/exam', 'ExamController@store')->name('api.exam.post');
// Route::delete('/exam/{exam}', 'ExamController@destroy')->name('api.exam.delete');
// Route::get('/exam', 'ExamController@show')->name('api.exam.show');

//考試, 番茄, 起床鬧鐘
Route::group([
    'prefix' => 'v1'
    ], function () {
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::apiResource('/exam', 'API\ExamController');
        Route::apiResource('/exam/{exam}/tomato', 'API\TomatoController');
        //Route::apiResource('/exam/{exam}/wakeup_alarm', 'API\WakeupAlarmController');
    });
});


//提醒鬧鐘, 待辦事項
Route::group([
    'prefix' => 'v1'
    ], function () {
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::apiResource('/task', 'API\TaskController');
        //Route::apiResource('/notify', 'API\NotifyController');
    });
});