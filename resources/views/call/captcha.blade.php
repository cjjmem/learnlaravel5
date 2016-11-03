@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row ">
            <div class="col-md-8 col-md-offset-2">
                <!--语音验证码-->
                <div class="sign-box">
                    <div class="head">
                        <div class="close"></div>
                        <div class="top">
                            <span class="title">语音验证码</span>（每个号码每天只能体验3次）
                        </div>
                        <div class="detail">验证码通过直呼用户手机并播放验证码，避免验证码到达不及时的问题</div>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="child-l  ">
                                    <div class="txtbox">
                                        <label class="label">手机号:</label>
                                        <input type="text" class="input middle-input" placeholder="请输入手机号码">
                                    </div>
                                    <div class="txtbox">
                                        <input type="text" class="input small-input left" placeholder="请输入验证码">
                                        <div class="myinput left"> <my-code></my-code></div>
                                    </div>
                                    <div class="txtbox">
                                        <button class="btn">发送</button>
                                    </div>
                                    <div class="txtbox">
                                        <span class="tips">正在拨打，请及时接听</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <div class="child-r ">
                                    <img src="{{ URL::asset('images/icon-feature-5.png') }}" class="img-box" alt=""
                                         width="185" height="135"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection