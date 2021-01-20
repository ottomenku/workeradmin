<?php

namespace Ottomenku\Moview;
use Illuminate\Support\ServiceProvider;
use Ottomenku\Moview\MoHtml;

class MoHtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('MoHtml', function () {
            return new MoHtml;
        });
  
    }
}


