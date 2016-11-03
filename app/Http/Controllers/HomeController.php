<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
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

}
