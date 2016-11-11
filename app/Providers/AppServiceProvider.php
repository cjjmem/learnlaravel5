<?php

namespace App\Providers;
use Log;
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
        //
        Queue::after(function ($connection, $data = array()) {
            Log::info(json_encode($connection));
            Log::info(json_encode($data));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
