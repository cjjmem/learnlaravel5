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

/**
 * 图形验证码
 */
Route::any('captcha-img', function(){return captcha_img('flat');});

/**
 * 微信消息入口
 */
Route::any('/wechat', 'WechatController@serve');

//微信容器设置demo
Route::get('/content','WechatController@content');
//壹耘sdk demo
Route::get('/yun','WechatController@yun');



Route::get('/', function () {
    return view('welcome');
});

Route::auth();


//快速体验
Route::get('quick/callback', 'CallController@callback'); //语音回拨
Route::get('quick/notify', 'CallController@notify');    //语音通知
Route::get('quick/captcha', 'CallController@captcha');  //语音验证码


Route::get('/home', 'HomeController@index');
Route::get('/home/article', 'HomeController@article');

Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');

Route::get('now',function(){
    return date('Y-m-d H:i:s');
});

Route::get('send','HomeController@send');


//后台管理
//中间件 'middleware'=>'auth'
//Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/article','HomeController@article');
});
