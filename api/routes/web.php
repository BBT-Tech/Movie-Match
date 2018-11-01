<?php

use Illuminate\Support\Facades\Storage;

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
    Route::post('init', 'InitController');
    Route::middleware('login')->group(function () {
        Route::post('register', 'RegisterController@first')
            ->middleware('validate:register');
        Route::post('query', 'QueryController');
        Route::post('cancel', 'CancelController')
            ->middleware('validate:cancel');
        Route::post('second', 'RegisterController@second')
            ->middleware('validate:second');
        Route::get('image', function () {
            return response(Storage::get('heart/' . $_SESSION['openid'] . '.png'))
                ->header('Content-type', 'image/png');
        });
    });
});

