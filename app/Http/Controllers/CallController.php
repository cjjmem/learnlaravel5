<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Captcha;
use App\Http\Requests;

class CallController extends Controller
{

    function __construct(){

        $this->middleware('oneyun');

    }

    /**
     * 语音回拨
     */
    public function callback(Request $request)
    {
        if ($request->isMethod('post')) {

            dd($request->all());

            //return redirect('/')->with('ok', trans('front/contact.ok'));

            return response()->json(['statut' => 'ok']);
        }

        return view('call/callback');
    }


    /**
     * 语音验证码
     */
    public function captcha()
    {
        return view('call/captcha');
    }

    /**
     * 语音通知
     */
    public function notify()
    {
        return view('call/notify');
    }


}
