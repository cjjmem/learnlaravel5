#队列 Queue

##配置文件  

**config/queue.php**

| 驱动队列 | 说明 |
|----|----|
|  `sync`|  同步|
|  `database`  | 数据库驱动|
|  `beanstalkd ` |  高性能、轻量级的分布式内存队列系统|
|  `sqs`  | sqs 驱动|
|`redis`| redis 驱动|

##创建队列数据表
    php artisan queue:table
    php artisan queue:failed-table
    php artisan migrate  //迁移
    
##创建队列
    php artisan make:job SendEail
    
##监听队列
    php artisan queue:listen
    php artisan queue: work
    
   *  队列优先级 *php artisan queue:listen --queue=high,low*
   *  指定任务超时参数 *php artisan queue:listen --timeout=60* 
   *  指定队列睡眠时间  *php artisan queue:listen --sleep=5*

##重试失败命令
    
   *  重试所有失败任务 *php artisan queue:retry all*
   *  删除一个失败任务 *php artisan queue:forget 5* 
   *  删除所有失败任务 *php artisan queue:flush*

   
##任务类结构 
    
**app/Jobs/SendEmail.php**


```php
<?php

namespace App\Jobs;

use App\Jobs\Job;
use Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email =  $email;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('send email to ->' . $this->email);

    }
}

```

##推送任务队列

```php
<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Jobs\SendEmail;
use Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function send(){
       $this->dispatch(new SendEmail('475647150@qq.com'));
    }
}

```


###指定任务队列

要指定该队列，使用任务实例上的 **onQueue** 方法

```php
     $job = (new SendReminderEmail($user))->onQueue('emails');
     $this->dispatch($job);
```

###延迟任务

可以通过使用任务类上的**delay**方法来实现，该方法由Illuminate\Bus\Queueable trait提供

```php
     $job = (new SendReminderEmail($user))->delay(60);
     $this->dispatch($job);
```

###任务完成事件

**Queue::after** 方法允许你在队列任务执行成功后注册一个要执行的回调函数。在该回调中我们可以添加日志、统计数据。例如，我们可以在Laravel内置的 AppServiceProvider 中添加事件回调:

**app/Providers/AppServiceProvider**

```php

<?php

namespace App\Providers;

use Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function ($connection ) {
            //
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}

```



### linxu 启动 监听队列
   nohup php artisan queue:listen &

## linux 提供的进程监听器  Supervisor配置

Supervisor为Linux操作系统提供的进程监视器，将会在失败时自动重启queue:listen或queue:work命令，要在Ubuntu上安装Supervisor，使用如下命令：

```shell
    sudo apt-get install supervisor
```

Supervisor配置文件通常存放在/etc/supervisor/conf.d目录，在该目录中，可以创建多个配置文件指示Supervisor如何监视进程，例如，让我们创建一个开启并监视queue:work进程的laravel-worker.conf文件：

```shell
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/app.com/artisan queue:work sqs --sleep=3 --tries=3 --daemon
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
```

在本例中，numprocs指令让Supervisor运行8个queue:work进程并监视它们，如果失败的话自动重启。配置文件创建好了之后，可以使用如下命令更新Supervisor配置并开启进程：

```shell
sudo supervisord -c /etc/supervisord.conf
sudo supervisorctl -c /etc/supervisor/supervisord.conf
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

[supervisord文档](http://supervisord.org/index.html)

    




    