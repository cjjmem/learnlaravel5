#安装
```
composer create-project laravel/laravel learnlaravel5 5.2.31
```

#运行
```
cd learnlaravel5/public
php -S 0.0.0.0:1024
```

#运行内置的登录注册功能
```
php artisan make:auth
```

#创建数据库
```
laravel5
```

#修改.env配置文件
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel5
DB_USERNAME=root
DB_PASSWORD=root
```

#数据迁移
```
php artisan migrate
```

#创建模型
```
php artisan make:model Article
```
#创建控制器
```
php artisan make:controller Admin/ArticleController
```

###生成Migration 创建数据库sql脚本
```
php artisan make:migration create_article_table
```

####执行
```
php artisan migrate
```

####Seeder 是我们接触到的一个新概念，字面意思为播种机。Seeder 解决的是我们在开发 web 应用的时候，需要手动向数据库中填入假数据的繁琐低效问题。

####创建Seeder文件
```
php artisan make:seeder ArticleSeeder
```

####添加代码 目录 database/seeds/ArticleSeeder.php
```php
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\Article::create([
                'title'   => 'Title '.$i,
                'body'    => 'Body '.$i,
                'user_id' => 1,
            ]);
        }
    }
}
```

####添加引入/database/seeds/DatabaseSeeder.php
```php
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ArticleSeeder::class);
    }
}
```

####由于 database 目录没有像 app 目录那样被 composer 注册为 psr-4 自动加载，采用的是 psr-0 classmap 方式，所以我们还需要运行以下命令把 ArticleSeeder.php 加入自动加载系统，避免找不到类的错误
```
//安装
composer dump-autoload
//执行
php artisan db:seed
```



