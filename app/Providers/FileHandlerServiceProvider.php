<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class FileHandlerServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind('FileHandler', function()
        {
            return new \App\Handlers\FileHandler;
        });
    }

}
