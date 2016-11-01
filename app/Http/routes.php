<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();


//快速体验
Route::get('quick/callback', 'CallController@callback');
Route::get('quick/notify', 'CallController@notify');
Route::get('quick/captcha', 'CallController@captcha');


Route::get('/home', 'HomeController@index');
Route::get('/home/article', 'HomeController@article');

Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');

Route::get('now',function(){
    return date('Y-m-d H:i:s');
});

//后台管理
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/article','HomeController@article');
});
