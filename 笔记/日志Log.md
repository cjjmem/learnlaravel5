#日志 错误 异常

##配置文件  

##日志

**config/app.php**
```php
'log' => 'daily'
```

| 日志模式 | 说明 |
|----|----|
|  `single`|  |
|  `daily`  | |
|  `syslog  ` | |
|  `errorlog`  | |

###Log 使用说明
```php
    Log::emergency($error);
    Log::alert($error);
    Log::critical($error);
    Log::error($error);
    Log::warning($error);
    Log::notice($error);
    Log::info($error);
    Log::debug($error);
```

##Monolog配置

##异常处理器

### report方法
report方法用于记录异常并将其发送给外部服务如Bugsnag。默认情况下，report方法只是将异常传递给异常被记录的基类，你可以随心所欲的记录异常。

例如，如果你需要以不同方式报告不同类型的异常，可使用PHP的instanceof比较操作符：

```
/**
 * 报告或记录异常
 *
 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
 *
 * @param  \Exception  $e
 * @return void
 */
public function report(Exception $e){
    if ($e instanceof CustomException) {
        //
    }

    return parent::report($e);
}

```

### render方法
render方法负责将给定异常转化为发送给浏览器的HTTP响应，默认情况下，异常被传递给为你生成响应的基类。然而，你可以随心所欲地检查异常类型或者返回自定义响应：

```
/**
 * 将异常渲染到HTTP响应中
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $e
 * @return \Illuminate\Http\Response
 */
public function render($request, Exception $e){
    if ($e instanceof CustomException) {
        return response()->view('errors.custom', [], 500);
    }

    return parent::render($request, $e);
}
```


##HTTP异常
自定义HTTP状态码页面 resources/views/errors/404.blade.php

```php
    abort(404);
    abort(403, 'Unauthorized action.');

```


