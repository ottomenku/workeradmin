<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class ModelHandlerServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind('ModelHandler', function()
        {
            return new \App\Handlers\ModelHandler;
        });
    }

}
