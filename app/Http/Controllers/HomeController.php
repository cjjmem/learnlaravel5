<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Jobs\SendEmail;
use Validator;
use Redis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断验证码是否正确
        // $validator = Validator::make($request->all(), ['captcha' => 'required|captcha']);
        $values = Redis::lrange('names', 5, 10);
        $v = Redis::get('names');
        print_r($v);
        exit;
        return view('home');
    }

    /**
     * 文章列表
     */
    public function article()
    {
        echo 2;
        exit;
        // return view('article/list')->withArticles(\App\Article::all());
    }

    public function send(){
       dispatch(new SendEmail('475647150@qq.com'));
    }


}
