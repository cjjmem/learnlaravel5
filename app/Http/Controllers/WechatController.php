<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use EasyWeChat\Foundation\Application;
use Oneyun\Facades\OneyunWeb;


class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注 overtrue！";
        });
        Log::info('return response.');
        return $wechat->server->serve();
    }

    /**
     * 微信容器
     */
    public function content()
    {

    }

    /**
     * 壹耘容器
     */
    public function yun()
    {

        $oneyun = app('oneyun',['appId'=>'自定义id','apiUrl'=>'http://www.baidu.com']);



        //duoCallback($from1, $to1, $from2, $to2, $ring_tone, $ring_tone_mode, $max_dial_duration, $max_call_duration, $recording, $record_mode, $user_data)

        dd($oneyun->duoCallback(null, '13611460986', null, '17606661993', null, 0, 30, 3600, 0, 0, 'aaaaaaa'));



        echo 2;
    }


    /**
     * 发起HTTPS请求
     */
    function curl_post($url, $data = array())
    {
        //初始化curl
        $ch = curl_init();

        $data = json_encode($data);

        //生成包头
        $headers = array();
        $headers[] = 'Accept:application/json';

        //参数设置
        $res = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);


        //连接失败
        if ($result == FALSE) {
            $result = "{\"code\":\"100000\",\"msg\":\"网络错误\"}";
        }
        curl_close($ch);
        return $result;
    }


}
