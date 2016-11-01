<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CallController extends Controller
{

    public function __construct()
    {

    }


    /**
     * 语音回拨
     */
    public function callback(){
        return view('call/callback');
    }


    /**
     * 语音验证码
     */
    public function captcha(){
        return view('call/captcha');
    }

    /**
     * 语音通知
     */
    public function notify(){
        return view('call/notify');
    }


}
