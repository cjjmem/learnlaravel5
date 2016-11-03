@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">

                    <form action="/home" method="get">
                        <input type="text" name="captcha" />

                        <my-code></my-code>

                        <button type="submit">提交</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
