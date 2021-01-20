<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class CalendarHandlerServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind('CalendarHandler', function()
        {
            return new \App\Handlers\CalendarHandler;
        });
    }

}
