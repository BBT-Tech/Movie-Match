<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('web')->group(function () {
    // Route::get('inject/{id}', function ($id) {
    //     $_SESSION['openid'] = $id;
    // }); // 注入session
    // Route::prefix('test')->group(function () {
    //     Route::post('inject/{num}', 'TestController@inject'); // 注入num条随机数据
    //     Route::post('match1', 'TestController@match1'); // 进行第一次匹配
    //     Route::post('match2', 'TestController@match2'); // 进行第二次匹配
    // });
    Route::post('init', 'InitController');
    Route::middleware('login')->group(function () {
        Route::post('register', 'RegisterController@first')
            ->middleware('validate:register');
        Route::post('query', 'QueryController');
        Route::post('cancel', 'CancelController')
            ->middleware('validate:cancel');
        Route::post('second', 'RegisterController@second')
            ->middleware('validate:second');
        Route::prefix('image')->group(function () {
            Route::get('self', 'ImageController@self');
            Route::get('ta', 'ImageController@ta');
        });
    });
});

