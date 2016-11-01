@extends('layouts.app')
@section('content')
    <div class="container" id="callBox">
        <div class="row ">
            <div class="col-md-8 col-md-offset-2">
                <!--语音回拨-->
                <div class="sign-box table-cell">
                    <div class="head">
                        <div class="close"></div>
                        <div class="top">
                            <span class="title">语音回拨</span>（每个号码每天只能体验3次）
                        </div>
                        <div class="detail">用户发起请求，由云平台给主被叫双方拨打电话，进行通话</div>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="child-l">
                                    <div class="txtbox">
                                        <label class="label">手机号A:</label>
                                        <input type="text" class="input middle-input" placeholder="请输入手机号码">
                                    </div>
                                    <div class="txtbox">
                                        <label class="label">手机号B:</label>
                                        <input type="text" class="input middle-input" placeholder="请输入另一个手机号">
                                    </div>
                                    <div class="txtbox">
                                        <input type="text" class="input small-input" placeholder="请输入验证码">
                                    </div>
                                    <div class="txtbox">
                                        <button class="btn" v-on:click="test">免费通话</button>
                                    </div>
                                    <div class="txtbox">
                                        <span class="tips">正在拨打，请及时接听</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <img src="{{ URL::asset('images/icon-feature-2.png') }}" class="img-box" alt=""
                                     width="185" height="135"/>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

