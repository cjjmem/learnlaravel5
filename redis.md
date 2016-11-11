#redis 

##Composer安装predis/predis包（~1.0）
```php
    composer require  predis/predis 
```

##配置.evn文件 or confing/database.php
```php
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
```

##基本使用方法
###获取
```php
   namespace App\Http\Controllers;
   
   use Redis;
   use App\Http\Controllers\Controller;
   
   class UserController extends Controller{
       /**
        * 显示指定用户属性
        *
        * @param  int  $id
        * @return Response
        */
       public function showProfile($id)
       {
           $user = Redis::get('user:profile:'.$id);
           return view('user.profile', ['user' => $user]);
       }
   }
```

###设参
```php
    Redis::set('name', 'Taylor');
    $values = Redis::lrange('names', 5, 10);
```

###使用command 方法传递到服务器
```php
    $values = Redis::command('lrange', ['name', 5, 10]);
```

## 发布订阅
Redis还提供了调用Redis的publish和subscribe命令的接口。这些Redis命令允许你在给定“频道”监听消息，你可以从另外一个应用发布消息到这个频道，甚至使用其它编程语言，从而允许你在不同的应用/进程之间轻松通信。

首先，让我们使用subscribe方法通过Redis在一个频道上设置监听器。由于调用subscribe方法会开启一个常驻进程，我们将在Artisan命令中调用该方法：

```php
   namespace App\Console\Commands;
   
   use Redis;
   use Illuminate\Console\Command;
   
   class RedisSubscribe extends Command{
       /**
        * 控制台命令名称
        *
        * @var string
        */
       protected $signature = 'redis:subscribe';
   
       /**
        * 控制台命令描述
        *
        * @var string
        */
       protected $description = 'Subscribe to a Redis channel';
   
       /**
        * 执行控制台命令
        *
        * @return mixed
        */
       public function handle()
       {
           Redis::subscribe(['test-channel'], function($message) {
               echo $message;
           });
       }
   }
```
现在，我们可以使用publish发布消息到该频道：
```php
    Route::get('publish', function () {
        // 路由逻辑...
        Redis::publish('test-channel', json_encode(['foo' => 'bar']));
    });
```


###通配符订阅
```php
    Redis::psubscribe(['*'], function($message, $channel) {
        echo $message;
    });
    
    Redis::psubscribe(['users.*'], function($message, $channel) {
        echo $message;
    });

```
