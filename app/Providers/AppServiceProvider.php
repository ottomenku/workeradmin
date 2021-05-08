<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       if(isset($_SERVER['HTTP_HOST'])){
            $host=explode('.', $_SERVER['HTTP_HOST']);  
            if($host[0]=='test') {config()->set('database.default', 'testmysql');} 
        }

    } 
}
